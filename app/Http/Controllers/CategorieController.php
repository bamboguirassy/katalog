<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Panier;
use App\Models\Paproduit;
use App\Models\Produit;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop)
    {
        $categories = Categorie::where('shop_id',$shop->id)->orderby('nom')->get();
        return view('shop.categorie.list',compact('categories','shop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Shop $shop)
    {
        //
        $request->validate([
            'nom'=>'required'
        ]);
        $categorie = new Categorie($request->all());
        $categorie->shop_id = $shop->id;
        $categorie->active = true;
        $categorie->save(); 
        return redirect()->route('shop.categorie.index', ['shop' => $shop]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop, Categorie $categorie)
    {
        $produitRaws = DB::select('select produit_id from categorie_produits where categorie_id='.$categorie->id);
        $produitIds = [];
        foreach ($produitRaws as $produitRaw) {
            $produitIds[] = $produitRaw->produit_id;
        }
        $produits = Produit::whereIn('id',$produitIds)
        ->where('quantite','>',0)
        ->where('visible',true)
        ->paginate(10);
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
        return view('shop.categorie.show',compact('shop','produits','categorie','paProduits'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop, Categorie $categorie)
    {
        $request->validate([
            'nom'=>'required'
        ]);
        $categorie->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop, Categorie $categorie)
    {
        $categorie->delete();
        return redirect()->route('shop.categorie.index', compact('shop'));
    }
}
