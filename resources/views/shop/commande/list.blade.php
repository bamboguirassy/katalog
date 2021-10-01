@extends('base')

@section('title',"Liste des commandes - ".$shop->nom);

@section('description',"Liste des commandes de la boutique...")

@section('body')
<section data-bs-version="5.1" class="article3 cid-sIYwjjHCfB" id="content03-3m">

    <div class="container">
        <div class="row justify-content-end">

            <div class="counter-container col-12 col-md-12 m-auto col-lg-8">
                <div class="card">
                    <h2 class="mbr-section-title align-left mbr-fonts-style mb-3 display-7">
                        <strong>
                            @if (\Request::route()->getName()=='shop.commandes.en.attente')
                            Les commandes en attente
                            @elseif (\Request::route()->getName()=='shop.commandes.en.cours')
                            Les commandes en cours
                            @else
                            Toutes les commandes
                            @endif
                        </strong>
                    </h2>

                    <h3 class="mbr-section-subtitle align-left mbr-fonts-style mb-3 display-2">
                        <strong>Vous pouvez gérer les commandes directement sur votre
                            mobile</strong><strong><br></strong></h3>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 image-wrapper align-right">
                <img style="max-height: 300px;" src="{{ asset('assets/images/features2.jpg') }}" alt="">
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="info3 cid-sIYy7aHyFl" id="info3-3o">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-12 col-lg-10">
                <div class="card-wrapper">
                    <div class="card-box align-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="table1 marketm4_table1 cid-sIYA66Ebd1" id="table1-3s">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="text-center text-lg-left">
                    <h2 class="mbr-section-title mbr-bold mbr-fonts-style display-5">
                        Liste des @if (\Request::route()->getName()=='shop.commandes.en.attente')
                        commandes en attente
                        @elseif (\Request::route()->getName()=='shop.commandes.en.cours')
                        commandes en cours
                        @else
                        commandes (toutes)
                        @endif</h2>
                </div>
                <div class="row justify-content-between no-gutters">
                    <div class="col-lg-12 tables">
                        <div class="row justify-content-center no-gutters">
                            @foreach ($commandes as $commande)
                            <div class="col-sm-4 col-10 column" style="border: 1px solid lightgray;">
                                <a href="{{ route('shop.commande.show',compact('shop','commande')) }}">

                                    <div class="table__title text-center text-sm-left border__bot px-3">
                                        <h3 class="title mbr-medium mbr-fonts-style display-7">
                                            {{$commande->numero}}</h3>
                                    </div>
                                    <div class="cell text-center text-sm-left border__bot">
                                        <p class="mbr-fonts-style mbr-text display-4">
                                            {{date_format($commande->created_at,'d M, y à H:m:s')}}</p>
                                    </div>
                                    <div class="cell text-center text-sm-left border__bot">
                                        <p class="mbr-fonts-style mbr-text display-4">{{$commande->user->name}}
                                        </p>
                                    </div>
                                    <div class="cell text-center text-sm-left border__bot">
                                        <p class="mbr-fonts-style mbr-text display-4 text-primary">
                                            <div style="padding: 5px; border: 2px solid #1C73BA;">
                                                <strong>{{ $commande->etat }}</strong>
                                            </div>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            @if(count($commandes)<1) <h3>Aucune commande pour le moment !</h3>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection