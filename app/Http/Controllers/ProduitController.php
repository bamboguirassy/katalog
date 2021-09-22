<?php

namespace App\Http\Controllers;

use App\Models\Attribut;
use App\Models\AttributProduit;
use App\Models\Categorie;
use App\Models\Image;
use App\Models\Panier;
use App\Models\Paproduit;
use App\Models\Produit;
use App\Models\Shop;
use App\Models\ValeurAttributProduit;
use App\Models\VariantAttributeValue;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
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
    public function create(Shop $shop)
    {
        $categories = Categorie::where('shop_id',$shop->id)->orderby('nom')->get();
        $attributs = Attribut::where('shop_id',$shop->id)
        ->has('valeurs')
        ->with(['valeurs'])
        ->orderby('nom')
        ->get();
        return view('shop.produit.new',compact('shop','categories','attributs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Shop $shop)
    {
        $request->validate([
            'nom'=>'required',
            'description'=>'required',
            'categorie_id'=>'required',
            'prixUnitaire'=>'integer|required',
            'quantite'=>'integer',
            'photos'=>'required'
        ]);
        $produit = new Produit($request->all());
        $produit->shop_id = $shop->id;
        $produit->visible = true;
        DB::beginTransaction();
        try {
        $produit->save();
        if($request->get('hasMoreAttributes')) {
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
        }
        $i=0;
            foreach($request->file('photos') as $photoFile) {
                $image = new Image();
                // Filename To store
                $image->nom = $shop->pseudonyme.'_'.$produit->nom.'_'.uniqid().'.'.$photoFile->getClientOriginalExtension();
                $image->produit_id = $produit->id;
                if($i==0) {
                    $image->couverture = true;
                }
                $photoFile->storeAs('storage/produits/images/',$image->nom);
                $image->save();
                $i++;
            }
            DB::commit();
        } catch(Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect()->route('shop.produit.show',compact('shop','produit'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop, Produit $produit)
    {
        $produit = Produit::with(['categorie','attributs.attribut','attributs.valeurs.valeurAttribut','variants.attributValues.valeurAttributProduit.valeurAttribut','variants.images'])->find($produit->id);
        $attributs = Attribut::where('shop_id',$shop->id)->has('valeurs')->with(['valeurs'])->get();
        return view('shop.produit.show',compact('produit','shop','attributs'));
    }

    /** for WS */
    public function get(Shop $shop, Produit $produit) {
        $produit = Produit::with(['categorie','attributs.attribut','attributs.valeurs.valeurAttribut','variants.attributValues','variants.attributValues.valeurAttributProduit.valeurAttribut','variants.images'])->find($produit->id);
        $attributs = Attribut::where('shop_id',$shop->id)->has('valeurs')->with(['valeurs'])->get();
        return compact('shop','produit','attributs');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop, Produit $produit)
    {
        $categories = Categorie::where('shop_id',$shop->id)->orderby('nom')->get();
        return view('shop.produit.edit',compact('shop','produit','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Shop $shop, Produit $produit)
    {
        $request->validate([
            'nom'=>'required',
            'description'=>'required',
            'categorie_id'=>'required',
            'prixUnitaire'=>'integer|required',
            'quantite'=>'integer',
            'visible'=>'required'
        ]);
        $data = $request->all();
        $data['visible']=($request->get('visible')=='Oui');
        $produit->update($data);
        return redirect()->route('shop.catalogue',compact('shop'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop, Produit $produit)
    {
        $produit->delete();
        return redirect()->route('shop.catalogue',compact('shop','produit'));
    }

    public function display(Shop $shop, Produit $produit) {
        $produit = Produit::with(['attributs.attribut','attributs.valeurs.valeurAttribut','imageCouverture','images','variants.images','variants.attributValues.valeurAttributProduit.valeurAttribut'])->find($produit->id);
        // find user panier if exists
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
        return view('shop.produit.display',compact('produit','shop','paProduits'));
    }

    public function addImages(Request $request, Shop $shop, Produit $produit) {
        $request->validate([
            'photos'=>'required'
        ]);
        DB::beginTransaction();
            foreach($request->file('photos') as $photoFile) {
                $image = new Image();
                // Filename To store
                $image->nom = $shop->pseudonyme.'_'.$produit->nom.'_'.uniqid().'.'.$photoFile->getClientOriginalExtension();
                $image->produit_id = $produit->id;
                $photoFile->storeAs('storage/produits/images/',$image->nom);
                $image->save();
            }
        DB::commit();
        return back();
    }

    public function updateCouvertureImage(Shop $shop, Image $image) {
        DB::beginTransaction();
        try {
            $otherImages = Image::where('produit_id',$image->produit_id)
            ->where('couverture',true)->get();
            foreach($otherImages as $otherImage) {
                $otherImage->update(['couverture'=>false]);
            }
            $image->update(['couverture'=>true]);
            DB::commit();
        } catch(Exception $e) {
            DB::rollback();
            throw $e;
        }
        return back();
    }

    public function createCombination(Shop $shop, Produit $produit) {
        $valeurTabs = $this->cartesian($produit->attributs);
        DB::beginTransaction();
        try {
            $i=1;
            foreach($valeurTabs as $valeurTab) {
                $sousProduit = new Produit();
                $sousProduit->produit_id = $produit->id;
                $sousProduit->nom = $produit->nom.'-variant-'.$i;
                $sousProduit->save();
                foreach($valeurTab as $valeur) {
                    $variantAttributValue = new VariantAttributeValue();
                    $variantAttributValue->produit_id = $sousProduit->id;
                    $variantAttributValue->valeur_attribut_produit_id = $valeur;
                    $variantAttributValue->save();
                }
                $i=$i+1;
            }
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return true;
    }

    /** WS */
    public function updateVariant(Request $request, Shop $shop, Produit $produit) {
        $request->validate([
            'prixUnitaire'=>'numeric|required',
            'quantite'=>'numeric|required'
        ]);
        $produit->configured = true;
        if($produit->update($request->only(['prixUnitaire','quantite']))) {
            return ['error'=>false];
        }
        return ['error'=>true,'message'=>"Une erreur est survenue lors de la mise à jour de la variante..."];
    }

    /** WS */
    public function removeVariant(Request $request, Shop $shop, Produit $produit) {
        if($produit->delete()) {
            return ['error'=>false];
        }
        return ['error'=>true,'message'=>"Une erreur est survenue lors de la suppression du produit..."];
    }

    function cartesian($attributs) {
        $result = array(array());
        foreach ($attributs as $key => $attribut) {
            $append = array();
            foreach($result as $product) {
                foreach($attribut->valeurs as $item) {
                    $product[$key] = $item->id;
                    $append[] = $product;
                }
            }
            $result = $append;
        }
        return $result;
    }
    

    function totalTabSize($tabOfTab,$i,$size) {
        if($i==count($tabOfTab)) {
            return $size;
        }
        if(is_numeric($i)) {
            $size = $size*count($tabOfTab[$i]);
            $i=$i+1;
            return $this->totalTabSize($tabOfTab,$i,$size);
        }
    }

    /** for autocomplete search WS */
    public function filterAutocomplete(Shop $shop) {
        return Produit::where('shop_id',$shop->id)
        ->where('visible',true)
        ->where('produit_id',null)
        ->with(['categorie','imageCouverture'])
        ->get();
    }
       
}
