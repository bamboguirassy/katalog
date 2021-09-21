<?php

namespace App\Http\Controllers;

use App\Models\Attribut;
use App\Models\AttributProduit;
use App\Models\Produit;
use App\Models\Shop;
use App\Models\ValeurAttributProduit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributProduitController extends Controller
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
     * @param  \App\Models\AttributProduit  $attributProduit
     * @return \Illuminate\Http\Response
     */
    public function show(AttributProduit $attributProduit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AttributProduit  $attributProduit
     * @return \Illuminate\Http\Response
     */
    public function edit(AttributProduit $attributProduit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AttributProduit  $attributProduit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttributProduit $attributProduit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttributProduit  $attributProduit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop,AttributProduit $attributProduit)
    {
        if($attributProduit->delete()) {
            return ['error'=>false];
        }
        return ['error'=>true,'message'=>"Une erreur est survenue pendant la suppression de l'attribut..."];
    }

    public function saveMultiple(Shop $shop, Produit $produit, Request $request) {
        $request->validate([
            'selectedAttrs'=>'array|required'
        ]);
        DB::beginTransaction();
        try {
            foreach ($request->get('selectedAttrs') as $selectedAttr) {
                $attribut = Attribut::find($selectedAttr);
                $attributProduit = new AttributProduit();
                $attributProduit->produit_id = $produit->id;
                $attributProduit->attribut_id = $selectedAttr;
                $attributProduit->save();
                // for each attribut, find values
                $attributValueIds = $request->get($attribut->nom);
                foreach ($attributValueIds as $attributValueId) {
                    $valeurAttributProduit = new ValeurAttributProduit();
                    $valeurAttributProduit->attribut_produit_id = $attributProduit->id;
                    $valeurAttributProduit->valeur_attribut_id = $attributValueId;
                    $valeurAttributProduit->save();
                }
            }
            DB::commit();
        } catch(Exception $e) {
            DB::rollback();
            throw $e;
        }
        return back();
    }

    public function addValeursToAttribut(Shop $shop, AttributProduit $attributProduit, Request $request) {
        $request->validate([
            'valeurs'=>'array|required'
        ]);
        DB::beginTransaction();
        try {
                // for each attribut, find values
                foreach ($request->get('valeurs') as $attributValueId) {
                    $valeurAttributProduit = new ValeurAttributProduit();
                    $valeurAttributProduit->attribut_produit_id = $attributProduit->id;
                    $valeurAttributProduit->valeur_attribut_id = $attributValueId;
                    $valeurAttributProduit->save();
                }
            DB::commit();
        } catch(Exception $e) {
            DB::rollback();
            throw $e;
        }
        return true;
    }

    public function remove(Shop $shop, AttributProduit $attributProduit) {
        if($attributProduit->delete()) {
            return ['error'=>false];
        }
        return ['error'=>true,'message'=>"Une erreur est survenue pendant la suppression de l'attribut..."];
    }

    public function removeValeur(Shop $shop, ValeurAttributProduit $valeurAttributProduit) {
        if($valeurAttributProduit->delete()) {
            $valeurs = ValeurAttributProduit::where('attribut_produit_id',$valeurAttributProduit->attribut_produit_id)->get();
            if(count($valeurs)<1) {
                AttributProduit::find($valeurAttributProduit->attribut_produit_id)->delete();
            }
            return ['error'=>false];
        }
        // chercher les valeurs du produit, s'il n'en reste, on supprime l'attribut
        return ['error'=>true,'message'=>"Une erreur est survenue pendant la suppression de la valeur de l'attribut..."];
    }
}
