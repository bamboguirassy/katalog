@extends('base')

@section('title','Mon panier - '.$shop->nom);

@section('description',"Votre panier chez la boutique ".$shop->nom)

@section('body')
<div class="row" ng-cloak>
    <div class="col-12" ng-controller="PanierController" ng-init="initPanier({{$panier}},{{$montant}})">
        <section data-bs-version="5.1" class="content1 cid-sITwirkIJg" id="content01-38">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 col-lg md-pb text-white">
                        <div class="text-wrapper">
                            <h3 class="mbr-section-title align-left mbr-fonts-style mb-5 display-1">Mon panier chez
                                {{$shop->nom}}.</h3>
                            <p class="mbr-text mbr-fonts-style align-left mb-5 display-7">
                                Retrouvez l'ensemble des produits ajoutés à votre panier afin de finaliser
                                la commande.</p>
                            <div class="link-wrap pt-2">
                                <a href="{{ route('shop.home',compact('shop')) }}">
                                    <span class="link mbr-fonts-style display-4">
                                        <strong>Continuer mes
                                            achats</strong>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4">
                        <div class="image-wrapper">
                            <img style="max-height: 400px; object-fit: cover;" src="{{ asset('uploads/shops/'.$shop->logo) }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if($panier && count($panier->produits)>0)
        <section data-bs-version="5.1" class="content3 cid-sITwhqEfMF" id="content03-37">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="counter-container col-md-12 col-lg-">
                        <h3 class="mbr-section-title mbr-fonts-style mb-2 display-5">Produit(s) sélectionné(s)</h3>
                        <h4 class="mbr-section-subtitle mbr-fonts-style mb-5 display-7">Voici la liste des produits
                            ajoutés à votre panier.<br>Vous pouvez
                            <a href="{{ route('shop.home',compact('shop')) }}"
                                class="text-primary"><strong><em>poursuivre vos
                                        achats</em></strong></a> si vous souhaitez ajouter plus de produits</h4>
                        <div class="row first" ng-repeat="produit in panier.produits">
                            <div class="col-lg-4">
                                <p class="mbr-text mbr-fonts-style display-4">
                                    <a
                                        href="/@{{shop.pseudonyme}}/produit/@{{produit.produit.id}}/display">@{{produit.produit.nom}}</a>
                                </p>
                                <div class="pb-2" ng-if="produit.produit.attribut_values.length>0">
                                    <ng-container ng-repeat="attributValue in produit.produit.attribut_values">

                                        <span>@{{attributValue.valeur_attribut_produit.valeur_attribut.attribut.nom}}
                                            :</span>
                                        <span
                                            ng-if="attributValue.valeur_attribut_produit.valeur_attribut.attribut.type=='couleur'"
                                            style="border: 2px solid #1C73BA; background-color: @{{attributValue.valeur_attribut_produit.valeur_attribut.valeur}}">
                                            &nbsp; &nbsp;
                                        </span>
                                        <span
                                            ng-if="attributValue.valeur_attribut_produit.valeur_attribut.attribut.type!='couleur'"
                                            style="padding: 2px; border: 2px solid #1C73BA;">@{{attributValue.valeur_attribut_produit.valeur_attribut.valeur}}</span>
                                    </ng-container>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <p class="mbr-text mbr-fonts-style display-4">
                                    @{{ produit.produit.prixUnitaire }} FCFA<br></p>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-group mb-3">
                                    <button ng-click="reduceProduct(produit)"
                                        class="btn btn-primary mr-0" type="button"
                                        id="button-addon1">-</button>
                                    <input style="width: auto; max-width: 60px;" ng-model="produit.quantite" type="text" class="form-control" placeholder=""
                                        aria-label="Example text with button addon">
                                    <button ng-click="addMore(produit)" class="btn btn-primary"
                                        type="button" id="button-addon2">+</button>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <p class="mbr-text mbr-fonts-style display-4">
                                    @{{ produit.produit.prixUnitaire * produit.quantite }} FCFA</p>
                            </div>
                            <div class="col-lg-2">
                                <button ng-click="removeProduit(produit)" class="btn btn-danger">
                                    <span class="mbri-trash"></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">

                            </div>
                            <div class="col-lg-2">
                                Total
                            </div>
                            <div class="col-lg-2">
                                <p class="mbr-text mbr-fonts-style display-4">
                                    @{{ montant }} FCFA</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2">
                        @if(empty($panier->produits))
                        <h3>Votre panier est vide...</h3>
                        @else
                        <form action="{{route('shop.panier.convert', compact('shop','panier'))}}" method="post">
                            @csrf
                            @method('post')
                            <button class="btn btn-primary">Envoyer la commande</button>
                        </form>
                        @endif
                    </div>
                </div>

            </div>
        </section>
        @else
        <h3 class="text-center b">Votre panier est vide...</h3>
        @endif

        <section data-bs-version="5.1" class="info3 cid-sIYsC74kwn" id="info3-3c">
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

        <section data-bs-version="5.1" class="content4 cid-sIYrSkcD8K" id="extContacts4-3b">

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mbr-semibold pb-2 align-left mbr-fonts-style display-2">
                            {{$shop->nom}}
                        </h4>
                    </div>

                    <div class="col-lg-8">

                        <p class="mbr-text pb-2 align-left mbr-fonts-style display-4">
                            {{ $shop->description }}
                        </p>
                    </div>
                    <div class="col-lg-4">
                        <p class="items items-col align-left mbr-fonts-style display-4">
                            <strong>EMAIL:</strong> &nbsp;<a
                                href="mailto:{{$shop->email}}">{{$shop->email}}</a><br><strong>CATEGORIE:</strong>
                            &nbsp;{{$shop->categorie->nom}}<br>
                            <strong>TELEPHONES:
                            </strong>&nbsp;
                            <a href="tel:{{$shop->telephonePrimary}}"
                                class="text-primary">{{$shop->telephonePrimaire}}</a>
                            @isset($shop->telephoneSecondaire)
                            / <a href="tel:{{$shop->telephoneSecondaire}}"
                                class="text-primary">{{$shop->telephoneSecondaire}}</a>
                            @endisset
                            <br>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection