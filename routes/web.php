<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Models\Categorie;
use App\Models\Panier;
use App\Models\Paproduit;
use App\Models\Produit;
use App\Models\Shop;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $shops = Shop::with(['categorie'])->paginate(10);
    return view('home',compact('shops'));
})->name('home');

Route::post('login', function (Request $request) {
    $validator = Validator::make($request->all(),['password'=>'required',
        'email'=>'email|required']);
    if(Auth::attempt($request->only(['email','password']))) {
        return back();
    }
    $validator->after(function ($validator) {
        $validator->errors()->add('idenfiants',"Vos identifiants de connexion sont incorrects, merci de vérifier !");
    });
    $validator->validate();
})->name('login');

Route::post('logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

Route::get('/new-shop', function () {
    $types = Type::all();
    return view('shop.new',compact('types'));
})->name('shop.new');

Route::resource('shop', ShopController::class,
['except'=>['create']
]);

Route::resource('user', UserController::class,[
    'only'=>['store','update']
]);

Route::get('/mes-commandes', 'App\Http\Controllers\CommandeController@getUserCommandes')
->name('user.commande.list');

Route::group([
    'prefix'     => '/{shop:pseudonyme}',
], function () {
    // Tenant routes here
       Route::name('shop.')->group(function() {

           Route::get('/',function(Shop $shop) {
               $categories = Categorie::where('shop_id',$shop->id)->has('produits')->orderby('nom')->get();
               $produits = Produit::where('shop_id',$shop->id)
               ->where('visible',true)
               ->where('quantite','>',0)
               ->paginate(9);
               // find user panier if exists
               $paProduits = [];
               if(Auth::user()) {
                   $panier = Panier::where('user_id',Auth::user()->id)
                    ->where('shop_id',$shop->id)
                    ->with('produits')
                    ->first();
                    $paproduits = [];
                    if(isset($panier)) {
                        $paproduits = Paproduit::where('panier_id',$panier->id)
                        ->get();
                    }
                    if(count($paproduits)>0) {
                        foreach($paproduits as $paproduit) {
                            $paProduits[] = $paproduit->produit_id;
                        }
                    }
               }
               return view('shop.home',compact('shop', 'produits','categories','paProduits'));
           })->name('home');

           Route::get('/infos',function(Shop $shop) {
                return view('shop.details',compact('shop'));
           })->name('details');
   
           Route::get('/catalogue', function(Shop $shop) {
               $produits = Produit::where('shop_id',$shop->id)
               ->paginate(9);
               return view('shop.catalogue',compact('shop','produits'));
           })->middleware('is.owner')->name('catalogue');

           Route::resource('/categorie', CategorieController::class,
                ['except'=>['create','show','edit']
            ])->middleware('is.owner');

           Route::resource('/commande', CommandeController::class,
                ['only'=>['show']
            ])->middleware('auth');

           Route::resource('/commande', CommandeController::class,
                ['only'=>['index','update']
            ])->middleware('is.owner');

            Route::resource('/categorie', CategorieController::class,
                ['only'=>['show']
            ]);

            Route::get('/produit/{produit}/display', 'App\Http\Controllers\ProduitController@display')
            ->name('produit.display');

            Route::resource('/produit', ProduitController::class,
                ['except'=>['index']
            ])->middleware('is.owner');

            Route::resource('/image', ImageController::class,
                    ['only'=>['destroy']
                ])->middleware('is.owner');

            Route::post('panier/addproduct','App\Http\Controllers\PanierController@addProduit')
                ->middleware('auth')
                ->name('panier.produit.save');

            Route::get('panier/retrieve','App\Http\Controllers\PanierController@retrieveUserPanier')
                ->middleware('auth')
                ->name('panier.retrieve');

            Route::post('panier-convert/{panier}','App\Http\Controllers\PanierController@convertToCommande')
                ->middleware('auth')
                ->name('panier.convert');
       });
});
