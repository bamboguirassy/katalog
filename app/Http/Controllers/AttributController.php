<?php

namespace App\Http\Controllers;

use App\Models\Attribut;
use App\Models\Shop;
use Illuminate\Http\Request;

class AttributController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop)
    {
        $attributs = Attribut::where('shop_id',$shop->id)
        ->with(['valeurs'])
        ->orderby('nom')->get();
        return view('shop.attribut.list',compact('shop','attributs'));
    }

    /**
     * Web Service call
     */
    public function findAll(Shop $shop)
    {
        $attributs = Attribut::where('shop_id',$shop->id)
        ->with(['valeurs'])
        ->orderby('nom')
        ->get();
        return $attributs;
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
            'nom'=>'required',
            'changePrice'=>'boolean|required'
        ]);
        $attribut = new Attribut($request->all());
        $attribut->shop_id = $shop->id;
        if($attribut->save()) {
            return ['error'=>false,'data'=>$attribut];
        }
        return ['error'=>true,'message'=>"Une erreur est survenue lors de l'enregistrement de l'attribut."];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attribut  $attribut
     * @return \Illuminate\Http\Response
     */
    public function show(Attribut $attribut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attribut  $attribut
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribut $attribut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attribut  $attribut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Shop $shop, Attribut $attribut)
    {
        $request->validate([
            'nom'=>'required',
            'shop_id'=>'required|exists:shops,id',
            'type'=>'required',
            'changePrice'=>'boolean|required'
        ]);
        if($attribut->update($request->all())) {
            return ['error'=>false,'data'=>$attribut];
        }
        return ['error'=>true,'message'=>"Une erreur est survenue lors de la mise à jour de l'attribut."];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attribut  $attribut
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop, Attribut $attribut)
    {
        if($attribut->delete()) {
            return ['error'=>false];
        }
        return ['error'=>true,'message'=>"Une erreur est survenue lors de la suppression de l'attribut"];
    }
}
