<?php

namespace App\Http\Controllers;

use App\Classes\PayTech;
use App\Mail\SendNewFacture;
use App\Models\Facture;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class FactureController extends Controller
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
        $request->validate([
            'titre'=>'required',
            'user_id'=>'required|exists:users,id',
            'montant'=>'numeric|min:5|required',
            'description'=>'required'
        ]);
        $user = User::find($request->get('user_id'));
        $facture = new Facture($request->all());
        $facture->delai = new DateTime($request->get('delai'));

        $baseUrl  = Config::get('app.env')=='local'?'https://katalog.tech':Config::get('app.url');
        
        if($facture->save()) {
            $jsonResponse = (new PayTech(Config::get('app.paytech_api_key'), Config::get('app.paytech_api_secret')))->setQuery([
                'item_name' => $facture->titre,
                'item_price' => $facture->montant,
                'command_name' => "Facture {$facture->titre} - via PayTech",
            ])->setCustomeField([
                'item_id' => $facture->id,
                'time_command' => time(),
                'ip_user' => $_SERVER['REMOTE_ADDR'],
                'lang' => $_SERVER['HTTP_ACCEPT_LANGUAGE']
            ])
                ->setTestMode(true)
                ->setCurrency('XOF')
                ->setRefCommand(uniqid())
                ->setNotificationUrl([
                    'ipn_url' => $baseUrl.'/facture/'.$facture->id.'/confirm', //only https
                    'success_url' => $baseUrl,
                    'cancel_url' =>   $baseUrl
                ])->send();
            if($jsonResponse['success']==1) {
                $facture->update(['lienPaiement'=> $jsonResponse['redirect_url']]);
                // send email to user
                Mail::to($user->email)->cc(Config::get('mail.cc'))->send(new SendNewFacture($facture));
            } else {
                return back()->withErrors(['error'=>'Une erreur est survenue lors de la génération du token de paiement']);
            }
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function show(Facture $facture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function edit(Facture $facture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facture $facture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facture $facture)
    {
        //
    }

    public function instantPaymentNotificate(Request $request, Facture $facture) {
        $type_event = $request->get('type_event');
        $payment_method = $request->get('payment_method');
        $client_phone = $request->get('client_phone');
        $api_key_sha256 = $request->get('api_key_sha256');
        $api_secret_sha256 = $request->get('api_secret_sha256');

        $my_api_key = Config::get('app.paytech_api_key');
        $my_api_secret = Config::get('app.paytech_api_secret');

        if(hash('sha256', $my_api_secret) === $api_secret_sha256 && hash('sha256', $my_api_key) === $api_key_sha256)
        {
            //from PayTech
            if($type_event=='sale_complete') {
                $facture->dateReglement = now();
                $facture->methodePaiement = $payment_method;
                $facture->clientPhone = $client_phone;
                $facture->update();
            } else {
                // notifier de paiement sale_canceled
            }
        }
        else{
            //not from PayTech
        }
    }
}
