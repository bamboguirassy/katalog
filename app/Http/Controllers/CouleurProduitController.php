<?php

namespace App\Http\Controllers;

use App\Models\CouleurProduit;
use App\Models\Image;
use App\Models\Shop;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CouleurProduitController extends Controller
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
     * @param  \App\Models\CouleurProduit  $couleurProduit
     * @return \Illuminate\Http\Response
     */
    public function show(CouleurProduit $couleurProduit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CouleurProduit  $couleurProduit
     * @return \Illuminate\Http\Response
     */
    public function edit(CouleurProduit $couleurProduit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CouleurProduit  $couleurProduit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CouleurProduit $couleurProduit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CouleurProduit  $couleurProduit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop, CouleurProduit $couleurproduit)
    {
        DB::beginTransaction();
        try {
            foreach($couleurproduit->images as $image) {
                Storage::delete('uploads/produits/images/'.$image->nom);
                $image->delete();
                $couleurproduit->delete();
            }
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return back();
    }

    public function addImages(Request $request, Shop $shop, CouleurProduit $couleurProduit) {
        $request->validate([
            'photos'=>'required'
        ]);
        DB::beginTransaction();
            foreach($request->file('photos') as $photoFile) {
                $image = new Image();
                // Filename To store
                $image->nom = $shop->pseudonyme.'_'.$couleurProduit->produit->nom.'_'.$couleurProduit->couleur->nom.'_'.uniqid().'.'.$photoFile->getClientOriginalExtension();
                $image->nom = str_replace(" ","_",$image->nom);
                $image->couleur_produit_id = $couleurProduit->id;
                $photoFile->storeAs('uploads/produits/images/',$image->nom);
                $image->save();
            }
        DB::commit();
        return back();
    }
}
