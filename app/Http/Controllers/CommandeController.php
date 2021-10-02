<?php

namespace App\Http\Controllers;

use App\Mail\CommandeAccepted;
use App\Models\Commande;
use App\Models\Shop;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
            $montant = $montant + ($coproduit->quantite*$coproduit->prixUnitaire);
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
        DB::beginTransaction();
        try {
            /** vérifier si l'état de la commande a changé */
            if($request->get('etat')!=$commande->etat) {
                /** vérifier si commande acceptée */
                if($request->get('etat')=='Acceptée') {
                    Mail::to($commande->user)->send(new CommandeAccepted($commande));
                }
            }
        $commande->update($request->only(['etat']));
        DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }
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
        ->paginate(6);
        return view('shop.commande.mes-commandes',compact('commandes'));
    }
}
