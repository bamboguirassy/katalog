<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ShopController;
use App\Models\Produit;
use App\Models\Shop;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    if(Auth::user() && Auth::user()->type=='owner') {
        return redirect()->route('shop.home', ['shop' => Auth::user()->shop]);
    }
    $shops = Shop::with(['categorie'])->paginate(10);
    return view('home',compact('shops'));
})->name('home');

Route::post('login', function (Request $request) {
    $validator = Validator::make($request->all(),['password'=>'required',
        'email'=>'email|required']);
    if(Auth::attempt($request->only(['email','password']))) {
        return redirect()->route('shop.home', ['shop' => Auth::user()->shop]);
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

Route::group([
    'prefix'     => '/{shop:pseudonyme}',
], function () {
    // Tenant routes here
       Route::name('shop.')->group(function() {

           Route::get('/',function(Shop $shop) {
               $produits = Produit::where('shop_id',$shop->id)
               ->where('visible',true)
               ->where('quantite','>',0)
               ->paginate(9);
               return view('shop.home',compact('shop', 'produits'));
           })->name('home');
   
           Route::get('/catalogue', function(Shop $shop) {
               $produits = Produit::where('shop_id',$shop->id)
               ->paginate(9);
               return view('shop.catalogue',compact('shop','produits'));
           })->middleware('is.owner')->name('catalogue');

           Route::resource('/categorie', CategorieController::class,
                ['except'=>['create','show','edit']
            ])->middleware('is.owner');

            Route::get('/produit/{produit}/display', 'App\Http\Controllers\ProduitController@display')
            ->name('produit.display');

            Route::resource('/produit', ProduitController::class,
                ['except'=>['index']
            ])->middleware('is.owner');

            Route::resource('/image', ImageController::class,
                    ['only'=>['destroy']
                ])->middleware('is.owner');
       });
});
