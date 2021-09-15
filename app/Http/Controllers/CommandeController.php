<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop)
    {
        $commandes = Commande::where('shop_id',$shop->id)
        ->orderby('created_at','desc')
        ->paginate(20);
        return view('shop.commande.list',compact('commandes','shop'));
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
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop, Commande $commande)
    {
        $montant = 0;
        foreach($commande->produits as $coproduit) {
            $montant = $montant + ($coproduit->quantite*$coproduit->produit->prixUnitaire);
        }
        return view('shop.commande.show',compact('shop','commande','montant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop, Commande $commande)
    {
        //
        $request->validate([
            'etat'=>'in:Acceptée,Rejetée,Livrée,Annulée'
        ]);
        $commande->update($request->only(['etat']));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande)
    {
        //
    }

    public function getUserCommandes() {
        $commandes = Commande::where('user_id',Auth::user()->id)
        ->orderby('created_at','desc')
        ->paginate(10);
        return view('shop.commande.mes-commandes',compact('commandes'));
    }
}
