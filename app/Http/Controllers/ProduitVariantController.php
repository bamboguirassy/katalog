<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\ProduitVariant;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduitVariantController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProduitVariant  $produitVariant
     * @return \Illuminate\Http\Response
     */
    public function show(ProduitVariant $produitVariant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProduitVariant  $produitVariant
     * @return \Illuminate\Http\Response
     */
    public function edit(ProduitVariant $produitVariant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\ProduitVariant  $produitVariant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Shop $shop, ProduitVariant $produitvariant)
    {
        $request->validate([
            'prixUnitaire'=>'required|numeric|min:0',
            'quantite'=>'required|numeric|min:0'
        ]);
        $produitvariant->configured = true;
        if($produitvariant->update($request->only(['prixUnitaire','quantite']))) {
            return ['error'=>false];
        }
        return ['error'=>true,'message'=>"Une erreur est survenue lors de la mise à jour de la variante... "];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProduitVariant  $produitVariant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop, ProduitVariant $produitvariant)
    {
        if($produitvariant->delete()) {
            return ['error'=>false];
        }
        return ['error'=>true,'message'=>"Une erreur est survenue lors de la suppression de la variante... "];
    }

    public function addImages(Request $request, Shop $shop, ProduitVariant $produitVariant) {
        $request->validate([
            'photos'=>'required'
        ]);
        DB::beginTransaction();
            foreach($request->file('photos') as $photoFile) {
                $image = new Image();
                // Filename To store
                $image->nom = $shop->pseudonyme.'_'.$produitVariant->produit->nom.'variant-'.$produitVariant->id.'_'.uniqid().'.'.$photoFile->getClientOriginalExtension();
                $image->produit_variant_id = $produitVariant->id;
                $photoFile->storeAs('storage/produits/images/',$image->nom);
                $image->save();
            }
        DB::commit();
        return back();
    }
}
