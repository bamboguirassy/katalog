<?php

namespace App\Http\Controllers;

use App\Mail\ShopCreated;
use App\Models\Shop;
use App\Models\Type;
use App\Models\User;
use App\Notifications\ShopCreated as NotificationsShopCreated;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
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
        Validator::validate($request->all(),
        [
            'nom'=>'unique:shops,nom|required',
            'pseudonyme'=>'min:6|required|unique:shops,pseudonyme',
            'categorie_id'=>'required',
            'telephonePrimaire'=>"required",
            'description'=>'required',
            'adresse'=>'required',
            'email'=>'required|unique:shops,email|unique:users,email',
            'password'=>'required|min:6|confirmed',
            'couleur'=>'required'
        ]);
        $user = new User();
        $user->name = $request->get('nom');
        $user->email = $request->get('email');
        $user->telephone = $request->get('telephonePrimaire');
        $user->type = 'owner';
        $user->password = Hash::make($request->get('password'));
        $shop = new Shop($request->all());
        
        if($request->hasFile('logo')) {
            Validator::validate($request->only('logo'),['logo'=>'image']);
            // Filename To store
            $filename = $request->get('pseudonyme').'.'.$request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('uploads/shops', $filename);
            $shop->logo = $filename;
        }
        
        DB::beginTransaction();
        try {
            $user->save();
            $shop->user_id = $user->id;
            $shop->save();
            Mail::to($shop->email)->cc('contact@bambogroup.net')->send(new ShopCreated($shop, $request->get('password')));
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }
        Auth::attempt($request->only(['email','password'],true));
       // $user->notify(new NotificationsShopCreated($shop));
        return redirect()->route('shop.categorie.index',['shop'=>$shop]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        $types = Type::all();
        return view('shop.edit',compact('shop','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $request->validate([
            'nom'=>'required',
            'pseudonyme'=>'required',
            'categorie_id'=>'exists:types,id',
            'telephonePrimaire'=>'required|min:9',
            'description'=>'required',
            'couleur'=>'required|min:7',
            'email'=>'required|email'
        ]);
        DB::beginTransaction();
        try {
        // verifier si le nouveau pseudo n'est pas utilisé
        $shopVerif = Shop::where('pseudonyme',$request->get('pseudonyme'))->where('id','!=',$shop->id)->get();
        if(count($shopVerif)>0) {
            return back()->withErrors(['error'=>"Ce pseudonyme est déja utilisé par une autre boutique..."]);
        }
        /** Vérifier si le mail n'a pas changé */
        if($shop->email!=$request->get('email')) {
            /** vérifier si le nouveau mail n'est pas usé par une boutique  */
            Validator::validate($request->only('email'),['email'=>'unique:shops,email|unique:users,email']);
            $shop->user->email = $request->get('email');
            $shop->user->update();
        }
        /** vérifier si le nom a changé et mettre à jour le user name */
        if($shop->nom!=$request->get('nom')) {
            /** mettre à jour le user name */
            $shop->user->name = $request->get('nom');
            $shop->user->update();
        }
        $shop->update($request->all());
        DB::commit();
    } catch(Exception $e) {
        DB::rollBack();
        throw $e;
    }
        return redirect()->route('shop.details',compact('shop'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }

    public function search(Request $request) {
        $request->validate(['pseudonyme'=>'required|exists:shops,pseudonyme']);
        $shop = Shop::where('pseudonyme',$request->get('pseudonyme'))->where('enabled',true)->first();
        if(!$shop) {
            return back()->withErrors(['error'=>'La boutique recherchée est en mode hors ligne !']);
        }
        return redirect()->route('shop.home', compact('shop'));
    }

    public function uploadLogo(Request $request, Shop $shop) {
        Validator::validate($request->all(),
        [
            'logo'=>'required|image'
        ]);
        
        if($request->hasFile('logo')) {
            Validator::validate($request->only('logo'),['logo'=>'image']);
            // Filename To store
            $filename = $shop->pseudonyme.'.'.$request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('uploads/shops', $filename);
            $shop->update(['logo'=>$filename]);
        }
        return back();
    }

    /** for autocomplete search WS */
    public function filterAutocomplete() {
        return Shop::where('enabled',true)->get();
    }
}
