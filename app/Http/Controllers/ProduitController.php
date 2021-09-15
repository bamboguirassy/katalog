<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Image;
use App\Models\Panier;
use App\Models\Paproduit;
use App\Models\Produit;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Shop $shop)
    {
        $categories = Categorie::where('shop_id',$shop->id)->orderby('nom')->get();
        return view('shop.produit.new',compact('shop','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Shop $shop)
    {
        $request->validate([
            'nom'=>'required',
            'description'=>'required',
            'categorie_id'=>'required',
            'prixUnitaire'=>'integer|required',
            'quantite'=>'integer',
            'photos'=>'required'
        ]);
        $produit = new Produit($request->all());
        $produit->shop_id = $shop->id;
        $produit->visible = true;
        DB::beginTransaction();
        $produit->save();
        $i=0;
            foreach($request->file('photos') as $photoFile) {
                $image = new Image();
                // Filename To store
                $image->nom = $shop->pseudonyme.'_'.$produit->nom.'_'.uniqid().'.'.$photoFile->getClientOriginalExtension();
                $image->produit_id = $produit->id;
                if($i==0) {
                    $image->couverture = true;
                }
                $photoFile->storeAs('public/produits/images/',$image->nom);
                $image->save();
                $i++;
            }
        DB::commit();
        return redirect()->route('shop.catalogue',compact('shop'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop, Produit $produit)
    {
        return view('shop.produit.show',compact('produit','shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop, Produit $produit)
    {
        $categories = Categorie::where('shop_id',$shop->id)->orderby('nom')->get();
        return view('shop.produit.edit',compact('shop','produit','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Shop $shop, Produit $produit)
    {
        $request->validate([
            'nom'=>'required',
            'description'=>'required',
            'categorie_id'=>'required',
            'prixUnitaire'=>'integer|required',
            'quantite'=>'integer',
        ]);
        $produit->update($request->all());
        return redirect()->route('shop.catalogue',compact('shop'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop, Produit $produit)
    {
        $produit->delete();
        return redirect()->route('shop.catalogue',compact('shop','produit'));
    }

    public function display(Shop $shop, Produit $produit) {
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
        return view('shop.produit.display',compact('produit','shop','paProduits'));
    }
}
