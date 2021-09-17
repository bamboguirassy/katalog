<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ValeurAttribut;
use Illuminate\Http\Request;

class ValeurAttributController extends Controller
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
    public function store(Shop $shop, Request $request)
    {
        $request->validate([
            'nom'=>'required',
            'valeur'=>'required',
            'attribut_id'=>'required|exists:attributs,id'
        ]);
        $valeurAttribut = new ValeurAttribut($request->all());
        if($valeurAttribut->save()) {
            return ['error'=>false,'data'=>$valeurAttribut];
        }
        return ['error'=>true, 'message'=>"Une erreur est survenue pendant l'enregistrement..."];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ValeurAttribut  $valeurAttribut
     * @return \Illuminate\Http\Response
     */
    public function show(ValeurAttribut $valeurAttribut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ValeurAttribut  $valeurAttribut
     * @return \Illuminate\Http\Response
     */
    public function edit(ValeurAttribut $valeurAttribut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ValeurAttribut  $valeurAttribut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop, ValeurAttribut $valeurAttribut)
    {
        $request->validate([
            'nom'=>'required',
            'valeur'=>'required',
            'attribut_id'=>'required|exists:attributs,id'
        ]);
        if($valeurAttribut->update($request->all())) {
            return ['error'=>false,'data'=>$valeurAttribut];
        }
        return ['error'=>true, 'message'=>"Une erreur est survenue pendant la mise à jour..."];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ValeurAttribut  $valeurAttribut
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop, ValeurAttribut $valeurAttribut)
    {
        if($valeurAttribut->delete()) {
            return ['error'=>false];
        }
        return ['error'=>true,'message'=>"Une erreur est survenue lors de la suppression de l'attribut"];
    }
}
