@extends('base')

@section('title','Commande '.$commande->numero);

@section('description',"La commande n° ".$commande->numero." chez ".$shop->nom)

@section('body')
<div class="row">
    <div class="col-12">
        <section data-bs-version="5.1" class="content02 cid-sIYyERI2Kj" id="content02-3r">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-4 image-wrapper">
                        <img class="w-100" src="{{ asset('storage/shops/'.$shop->logo) }}" alt="{{ $shop->logo }}">
                    </div>
                    <div class="col-12 col-md">
                        <div class="text-wrapper align-left">
                            <h3 class="mbr-section-title mbr-fonts-style mb-4 display-3"><strong>{{ $shop->nom }} -&gt;
                                    Commande n° {{ $commande->numero }}</strong></h3>
                            <p class="mbr-text mbr-fonts-style mb-4 display-7"></p>
                            <p>Voici les détails de la commande n° <b>{{ $commande->numero }}</b> passée dans la
                                boutique
                                <b>{{ $shop->nom }}</b>.
                            </p>
                            <p class="mbr-fonts-style text display-4">
                                <strong
                                    style="padding: 5px; border-radius: 15px; border-right: 2px solid #1C73BA; color: #1C73BA;">Statut
                                    actuel : {{$commande->etat}}</strong>
                            </p>
                            <p></p>
                            <div class="mbr-section-btn mt-3">
                                @foreach ($errors->all() as $message)
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endforeach
                                @if (auth()->user()->type=="owner" && auth()->user()->id==$shop->user_id)
                                @if ($commande->etat=='En attente')
                                <form style="display: inline; float: right; margin-left: 3px;"
                                    action="{{ route('shop.commande.update',compact('shop','commande')) }}"
                                    method="post">
                                    @csrf
                                    @method('put')
                                    <input hidden type="text" value="Acceptée" name="etat">
                                    <button class="btn btn-md btn-info display-4 m-0">
                                        <span class="fa fa-check-circle-o mbr-iconfont mbr-iconfont-btn"></span>
                                        Accepter</button>
                                </form>
                                <form style="display: inline; float: right; margin-left: 3px;"
                                    action="{{ route('shop.commande.update',compact('shop','commande')) }}"
                                    method="post">
                                    @csrf
                                    @method('put')
                                    <input hidden type="text" value="Rejetée" name="etat">
                                    <button class="btn btn-md btn-danger display-4">
                                        <span class="mdi-navigation-cancel mbr-iconfont mbr-iconfont-btn"></span>
                                        Rejeter</button>
                                </form>
                                @endif
                                @if ($commande->etat=='Acceptée')
                                <form style="display: inline; float: right; margin-left: 3px;"
                                    action="{{ route('shop.commande.update',compact('shop','commande')) }}"
                                    method="post">
                                    @csrf
                                    @method('put')
                                    <input hidden type="text" value="Livrée" name="etat">
                                    <button class="btn btn-md btn-primary display-4">
                                        <span class="fa fa-check-circle-o mbr-iconfont mbr-iconfont-btn"></span>
                                        Livrer</button>
                                </form>
                                @endif

                                @endif
                                @if (auth()->user()->id!=$commande->user_id)
                                <a class="btn btn-md btn-secondary display-4" href="tel:{{$commande->user->telephone}}">
                                    <span class="mobi-mbri mobi-mbri-phone mbr-iconfont mbr-iconfont-btn"></span>
                                    Contacter le client</a>
                                @elseif ($commande->etat=='En attente')
                                <form style="display: inline; float: right; margin-left: 3px;"
                                    action="{{ route('shop.commande.update',['commande'=>$commande,'shop'=>$commande->shop]) }}"
                                    method="post">
                                    @csrf
                                    @method('put')
                                    <input hidden type="text" value="Annulée" name="etat">
                                    <button class="btn btn-md btn-danger display-4">
                                        <span class="mbri-close mbr-iconfont mbr-iconfont-btn">
                                        </span>Annuler
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section data-bs-version="5.1" class="info3 cid-sIYAlof4Zy" id="info3-3t">
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
                                Produits commandés</h2>
                        </div>
                        <div class="row justify-content-between no-gutters">
                            <div class="col-lg-12 tables">
                                <div class="row justify-content-center no-gutters">
                                    @foreach ($commande->produits as $produit)
                                    <div class="col-sm-4 col-10 column" style="border: 2px solid gray;">
                                        <div class="table__title text-center text-sm-left border__bot px-3">
                                            <h3 class="title mbr-medium mbr-fonts-style display-7">
                                                {{$produit->produit->nom}}</h3>
                                        </div>
                                        <div class="cell text-center text-sm-left border__bot">
                                            <p class="mbr-fonts-style mbr-text display-4">
                                                {{$produit->prixUnitaire}} FCFA</p>
                                        </div>
                                        <div class="cell text-center text-sm-left border__bot">
                                            <p class="mbr-fonts-style mbr-text display-4">{{$produit->quantite}}
                                                unité(s)</p>
                                        </div>
                                        <div class="cell text-center text-sm-left border__bot">
                                            <p class="mbr-fonts-style mbr-text display-4">
                                                {{$produit->produit->prixUnitaire * $produit->quantite}} FCFA</p>
                                        </div>
                                        @if (count($produit->produit->attributValues)>0)
                                        <div class="cell">
                                            <div class="pb-2">
                                                @foreach ($produit->produit->attributValues as $attributValue)
                                                <span>{{$attributValue->valeurAttributProduit->valeurAttribut->attribut->nom}}
                                                    :</span>
                                                @if($attributValue->valeurAttributProduit->valeurAttribut->attribut->type=='couleur')
                                                <span
                                                    style="border: 2px solid #1C73BA; background-color: {{$attributValue->valeurAttributProduit->valeurAttribut->valeur}}">
                                                    &nbsp; &nbsp;
                                                </span>
                                                @else
                                                <span
                                                    style="padding: 2px; border: 2px solid #1C73BA;">{{$attributValue->valeurAttributProduit->valeurAttribut->valeur}}</span>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-3 flex-column text-center text-lg-left mt-5 content__block">
                                <h3 class="mbr-fonts-style title__text display-7"><strong>Montant</strong> :
                                    {{$montant}} FCFA
                                </h3>
                                <p class="mbr-fonts-style text display-4"><strong>Statut : {{$commande->etat}}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection