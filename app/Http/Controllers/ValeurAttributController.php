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
            'valeurs'=>'required|array',
            'attribut_id'=>'required|exists:attributs,id'
        ]);
        $valeurAttributs = [];
        foreach ($request->get('valeurs') as $value) {
            $valeurAttribut = new ValeurAttribut();
            $valeurAttribut->attribut_id = $request->get('attribut_id');
            $valeurAttribut->valeur = $value;
            $valeurAttribut->nom = $value;
            if(!$valeurAttribut->save()) {
                return ['error'=>true,'message'=>"Erreur lors de l'enregistrement de la valeur ".$value];
            }
            $valeurAttributs[] = $valeurAttribut; 
        }
        return ['false'=>true, 'data'=>$valeurAttributs];
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
