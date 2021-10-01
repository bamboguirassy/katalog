<?php

use App\Http\Controllers\AttributController;
use App\Http\Controllers\AttributProduitController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CouleurProduitController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValeurAttributController;
use App\Mail\ResetPassword;
use App\Models\Categorie;
use App\Models\CouleurProduit;
use App\Models\Facture;
use App\Models\Panier;
use App\Models\Paproduit;
use App\Models\Produit;
use App\Models\Shop;
use App\Models\Type;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;


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
    $shops = Shop::with(['categorie'])->where('enabled',true)->paginate(20);
    return view('home',compact('shops'));
})->name('home');

Route::post('login', function (Request $request) {
    $users = User::where('email',$request->get('email'))->get();
        if(count($users)<1) {
            return ['error'=>true,'message'=>"Vos identifiants de connexion sont invalides."];
        }
    $request->validate([
        'password'=>'required',
        'email'=>'email|required|exists:users,email'
    ]);
    if(Auth::attempt($request->only(['email','password']))) {
        $user = User::with(['shop'])->find(auth()->user()->id);
        return ['error'=>false,'data'=>$user];
    }
    return ['error'=>true,'message'=>'Identifiants de connexion invalides.'];
});

Route::get('/forgot-password',function() {
    return view('user.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password',function(Request $request) {
    $request->validate(['email'=>'email|exists:users,email']);
    /*$user = User::where('email',$request->get('email'))->first();
    Mail::to($user)->send(new ResetPassword($user));*/
    $status = Password::sendResetLink(
        $request->only('email')
    );
    return back()->with(['message'=>"Un mail de réinitialisation est envoyé à l'adresse indiquée. Merci de le consulter"]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}',function($token) {
    return view('user.reset-password',['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('home')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

Route::get('logout', function () {
    $user = Auth::user();
    Auth::logout();
    if($user->type=='owner') {
        return redirect()->route('shop.home',['shop'=>$user->shop]);
    } 
    return redirect()->route('home');
})->name('logout')->middleware('auth');

Route::get('profil',function() {
return view('user.profil',['user'=>Auth::user()]);
})->middleware('auth')->name('user.profil');

Route::get('/new-shop', function () {
    $types = Type::all();
    return view('shop.new',compact('types'));
})->name('shop.new');

Route::resource('shop', ShopController::class,
['except'=>['create']
]);

Route::post('update-password','App\Http\Controllers\UserController@updatePassword')
->name('user.update.password')->middleware('auth');

Route::get('/mes-commandes', 'App\Http\Controllers\CommandeController@getUserCommandes')
->name('user.commande.list');

Route::post('/search-shop', 'App\Http\Controllers\ShopController@search')
->name('shop.search');

/** for ws */
Route::get('/shop-autocomplete', 'App\Http\Controllers\ShopController@filterAutocomplete');

Route::group([
    'prefix'     => '/{shop:pseudonyme}',
], function () {
    // Tenant routes here
       Route::name('shop.')->group(function() {
           Route::get('/',function(Shop $shop) {
               $categories = Categorie::where('shop_id',$shop->id)->where('categorie_id',null)->has('produits')->withCount('produits')->orderby('nom')->get();
               $produits = Produit::where('shop_id',$shop->id)
               ->where('visible',true)
               ->where('quantite','>',0)
               ->paginate(18);
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

           Route::post('/update-shop-photo','App\Http\Controllers\ShopController@uploadLogo')
           ->name('update.shop.logo')->middleware('is.owner');

           Route::get('/infos',function(Shop $shop) {
                return view('shop.show',compact('shop'));
           })->name('details');
   
           Route::get('/catalogue', function(Shop $shop) {
               $produits = Produit::where('shop_id',$shop->id)
               ->paginate(15);
               return view('shop.catalogue',compact('shop','produits'));
           })->middleware('is.owner')->name('catalogue');

           Route::resource('/categorie', CategorieController::class,
                ['except'=>['create','show','edit']
            ])->middleware('is.owner');

            Route::get('/commande-en-attente',function(Shop $shop) {
                $commandes = $shop->commandeEnAttentes;
                return view('shop.commande.list',compact('commandes','shop'));
            })->middleware('is.owner')->name('commandes.en.attente');

            Route::get('/commande-en-cours',function(Shop $shop) {
                $commandes = $shop->commandeAcceptees;
                return view('shop.commande.list',compact('commandes','shop'));
            })->middleware('is.owner')->name('commandes.en.cours');

           Route::resource('/commande', CommandeController::class,
                ['only'=>['show','update']
            ])->middleware('auth');

           Route::resource('/commande', CommandeController::class,
                ['only'=>['index']
            ])->middleware('is.owner');

            Route::resource('/categorie', CategorieController::class,
                ['only'=>['show']
            ]);

            Route::resource('marque', MarqueController::class,[
                'except'=>['edit','update','create']
            ]);

            /** ws */
            Route::get('/produit-autocomplete', 'App\Http\Controllers\ProduitController@filterAutocomplete');

            Route::get('/produit/{produit}/display', 'App\Http\Controllers\ProduitController@display')
            ->name('produit.display');

            Route::post('/produit/add-images/{produit}', 'App\Http\Controllers\ProduitController@addImages')
            ->name('produit.add.images');

            Route::post('/couleurproduit/add-images/{couleurProduit}', 'App\Http\Controllers\CouleurProduitController@addImages')
            ->name('couleurproduit.add.images');

            Route::resource('couleurproduit',CouleurProduitController::class,[
                'only'=>['destroy']
            ])->middleware('is.owner');

            Route::post('/produit/change/photo-couverture/{image}', 'App\Http\Controllers\ProduitController@updateCouvertureImage')
            ->name('produit.update.couverture.photo');

            Route::get('/produit/{produit}/refresh', 'App\Http\Controllers\ProduitController@get')->middleware('is.owner');
            
            Route::post('/produit/{produit}/create-combination', 'App\Http\Controllers\ProduitController@createCombination')->middleware('is.owner');
            
            Route::put('/produit/{produit}/update-variant', 'App\Http\Controllers\ProduitController@updateVariant')->middleware('is.owner');
            
            Route::delete('/produit/{produit}/remove-variant', 'App\Http\Controllers\ProduitController@removeVariant')->middleware('is.owner');

            Route::resource('/produit', ProduitController::class,
                ['except'=>['index']
            ])->middleware('is.owner');

            Route::resource('/image', ImageController::class,
                    ['only'=>['destroy']
                ])->middleware('is.owner');

            Route::post('panier/addproduct','App\Http\Controllers\PanierController@addProduit')
                ->middleware('auth')
                ->name('panier.produit.save');
                /** ws */
            Route::get('panier/content','App\Http\Controllers\PanierController@getMyPanierContents')
                ->middleware('auth');
                /** ws */
            Route::put('panier/update-product-quantite/{paproduit}','App\Http\Controllers\PanierController@updatePaproductQuantite')
                ->middleware('auth');
                /** ws */
            Route::delete('panier/remove-product/{paproduit}','App\Http\Controllers\PanierController@removePaproductFromPanier')
                ->middleware('auth');

            Route::get('panier/show','App\Http\Controllers\PanierController@showUserPanier')
                ->middleware('auth')
                ->name('panier.show');

            Route::delete('panier/produit-delete/{paproduit}','App\Http\Controllers\PanierController@supprimerProduitPanier')
                ->middleware('auth')
                ->name('panier.produit.delete');

            /** Called by web service */
            Route::get('attribut/find_all', 'App\Http\Controllers\AttributController@findAll')->middleware('is.owner');

            Route::resource('attribut', AttributController::class,[
                'excepts'=>['show','edit','create']
            ])->middleware('is.owner');


            Route::resource('valeurattribut', ValeurAttributController::class,[
                'only'=>['store','update','delete']
            ]);
           
            Route::post('attributproduit/{attributProduit}/add-valeurs','App\Http\Controllers\AttributProduitController@addValeursToAttribut')
            ->middleware('is.owner');

            Route::delete('attributproduit/{attributProduit}/remove','App\Http\Controllers\AttributProduitController@remove')
            ->middleware('is.owner');

            Route::delete('attributproduit/{valeurAttributProduit}/remove-valeur','App\Http\Controllers\AttributProduitController@removeValeur')
            ->middleware('is.owner');

            Route::post('attributproduit/{produit}/add-multiple','App\Http\Controllers\AttributProduitController@saveMultiple')
            ->middleware('is.owner')->name('attributproduit.save.multiple');
            
            Route::resource('attributproduit', AttributProduitController::class);

            /**
             * For web service
             */
            Route::get('user/panier','App\Http\Controllers\PanierController@getMyPanier')
                ->name('user.panier');

            Route::post('panier-convert/{panier}','App\Http\Controllers\PanierController@convertToCommande')
                ->middleware('auth')
                ->name('panier.convert');
       }); 
});

Route::resource('user', UserController::class,[
    'only'=>['store','update']
]);

Route::post('facture/confirm','App\Http\Controllers\FactureController@instantPaymentNotificate')
->name('facture.pin');

Route::resource('facture', FactureController::class,[
    'only'=>['store']
])->middleware('admin');

Route::group([
    'prefix' => '/admin',
], function () {
    Route::name('admin.')->group(function() {
        /** Liste des shops */
        Route::get('shops', function () {
            $shops = Shop::withCount('produits','paniers','commandes','commandeEnAttentes',
            'commandeAcceptees','commandeLivrees','commandeRejetees','commandeAnnulees')->paginate(100);
            return view('admin.shop-list',compact('shops'));
        })->name('shops')->middleware('admin');
        /** Liste des users */
        Route::get('users', function() {
            $users = User::withCount('paniers','commandes','commandeEnAttentes',
            'commandeAcceptees','commandeLivrees','commandeRejetees','commandeAnnulees')
            ->paginate(100);
            return view('admin.user-list', compact('users'));
        })->name('users')->middleware('admin');
        /** Liste des factures */
        Route::get('factures',function() {
            $factures = Facture::orderby('created_at','desc')->get();
            $users = User::all();
            return view('admin.facture-list',compact('factures','users'));
        })->name('factures')->middleware('admin');
        /** Autocomplete users */
        Route::get('autocomplete-users', function() {
            $users = User::all();
            return $users;
        })->name('autocomplete.users')->middleware('admin');
    });
});