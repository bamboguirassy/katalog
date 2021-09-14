<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Coproduit;
use App\Models\Panier;
use App\Models\Paproduit;
use App\Models\Produit;
use App\Models\Shop;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PanierController extends Controller
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
     * @param  \App\Models\Panier  $panier
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop, Panier $panier)
    {
        return view('user.panier',compact('shop','panier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Panier  $panier
     * @return \Illuminate\Http\Response
     */
    public function edit(Panier $panier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Panier  $panier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Panier $panier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Panier  $panier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Panier $panier)
    {
        //
    }

    public function addProduit(Request $request, Shop $shop) {
        if(Auth::user() && Auth::user()->type=='client') {
            $produit = Produit::find($request->get('produit_id'));
            if($produit->quantite<$request->get('quantite')) {
                throw new Error("La quantité n'est pas disponible !");
            }

            $panier = Panier::where('user_id',Auth::user()->id)
            ->where('shop_id',$shop->id)
            ->first();
            DB::beginTransaction();
            if(!isset($panier)) {
                $data = [];
                $data['user_id'] = Auth::user()->id;
                $data['shop_id'] = $shop->id;
                $panier = Panier::create($data);
            }
            $paData = [];
            $paData['panier_id'] = $panier->id;
            $paData['produit_id'] = $request->get('produit_id');
            $paData['quantite'] = $request->get('quantite');
            Paproduit::create($paData);
            DB::commit();
        }
        return back();
    }

    public function retrieveUserPanier(Shop $shop)
    {
        $panier = Panier::where('shop_id',$shop->id)
        ->where('user_id',Auth::user()->id)
        ->first();
        $montant = 0;
        if($panier) {
            foreach($panier->produits as $paproduit) {
                $montant = $montant+($paproduit->quantite * $paproduit->produit->prixUnitaire);
            }
        }
        return view('user.panier',compact('shop','panier','montant'));
    }

    public function convertToCommande(Shop $shop, Panier $panier) {
        $commande = new Commande();
        $commande->shop_id = $panier->shop_id;
        $commande->user_id = $panier->user_id;
        $commande->numero = uniqid("CO-");
        $commande->save();
        DB::beginTransaction();
        try {
            foreach($panier->produits as $paproduit) {
                $coproduit = new Coproduit();
                $coproduit->commande_id = $commande->id;
                $coproduit->quantite = $paproduit->quantite;
                $coproduit->produit_id = $paproduit->produit_id;
                $coproduit->save();
                $paproduit->delete();
                $panier->delete();
            }
        } catch(Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect()->route('shop.commande.show', compact('shop','commande'));
    }
}
