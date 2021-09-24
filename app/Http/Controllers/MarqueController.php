<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use App\Models\Panier;
use App\Models\Paproduit;
use App\Models\Produit;
use App\Models\Shop;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop)
    {
        $marques = Marque::where('shop_id',$shop->id)->get();
        return view('shop.marque.list',compact('shop','marques'));
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
    public function store(Request $request,Shop $shop)
    {
        $request->validate([
            'nom'=>'required',
        ]);
        $marque = new Marque($request->all());
        $marque->shop_id = $shop->id;
        DB::beginTransaction();
        try {
            if($request->hasFile('logo')) {
                Validator::validate($request->only('logo'),['logo'=>'image']);
                // Filename To store
                $filename = $shop->pseudonyme.'-'.$marque->nom.'.'.$request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->storeAs('uploads/shops/marques', $filename);
                $marque->logo = $filename;
            }
            $marque->save();
            DB::commit();
        } catch(Exception $e) {
            DB::rollback();
            throw $e;
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marque  $marque
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop, Marque $marque)
    {
        
        $produits = Produit::where('marque_id',$marque->id)
        ->where('quantite','>',0)
        ->where('visible',true)
        ->paginate(10);
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
        return view('shop.marque.show',compact('shop','produits','marque','paProduits'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marque  $marque
     * @return \Illuminate\Http\Response
     */
    public function edit(Marque $marque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marque  $marque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marque $marque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marque  $marque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop, Marque $marque)
    {
        Storage::delete('uploads/shops/marques/'.$marque->logo);
        $marque->delete();
        return back();
    }
}
