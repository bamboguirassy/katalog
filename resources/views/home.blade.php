@extends('base')

@section('title',"Accueil");

@section('description',"Bienvenue sur la plateforme Katalog.
Ouvrez dès aujourd'hui petite boutique de vente en ligne et commencer à avoir plus de visibilité.")

@section('body')
<div class="row">
    <div class="col-12">
        <section data-bs-version="5.1" class="header2 cid-sIq8h1uDBV" id="header02-d">
            <div class="container">
                <div class="row row-bg justify-content-center">
                    <div class="col-12 md-pb col-md-12 col-lg-6">
                        <div class="text-wrapper align-left">
                            <h1 class="mbr-section-title align-left mbr-fonts-style mb-4 display-1">Katalog</h1>
                            <p class="mbr-text align-left mbr-fonts-style display-5">
                                Votre plateforme de vente pour booster votre commerce et augmenter votre visibilité.
                                Simplifiez vos statuts WhatsApp,
                                Instagram, Facebook et gérer votre catalogue et vos commandes en un seul et unique
                                endroit.</p>
                            <div class="mbr-section-btn mt-4">
                                @guest
                                <a class="btn btn-secondary display-7" href="{{ route('shop.new') }}"><span
                                        class="mobi-mbri mobi-mbri-arrow-next mbr-iconfont mbr-iconfont-btn"></span>Essayez gratuitement</a>
                                <a class="btn btn-success display-7" href="#" data-toggle="modal" data-bs-toggle="modal"
                                    data-target="#mbr-popup-1f" data-bs-target="#mbr-popup-1f"><span
                                        class="mobi-mbri mobi-mbri-login mbr-iconfont mbr-iconfont-btn"></span>Se
                                    connecter</a>
                                @endguest
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 image-wrapper">
                        <img class="w-100" src="{{ asset('assets/images/mbr.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section data-bs-version="5.1" class="features12 cid-sIq8p3szqN" id="features13-e">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6">
                        <div class="card-wrapper">
                            <div class="card-box align-left">
                                <h4 class="card-title mbr-fonts-style mb-4 display-2"><strong>C'est quoi Katalog
                                        ?</strong>
                                </h4>
                                <p class="mbr-text mbr-fonts-style mb-4 display-7">
                                    Votre plateforme d'exposition de produits en ligne pour une meilleure visibilité et
                                    une
                                    meilleure gestion des ventes.</p>
                                @guest
                                <div class="mbr-section-btn">
                                    <a class="btn btn-primary display-4" href="{{ route('shop.new') }}"><span
                                            class="mobi-mbri mobi-mbri-plus mbr-iconfont mbr-iconfont-btn"
                                            style="color: #1C73BA;"></span>Essayez gratuitement ma boutique&nbsp;</a>
                                </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="item mbr-flex">
                            <div class="icon-box">
                                <span class="mbr-iconfont mobi-mbri-globe-2 mobi-mbri"></span>
                            </div>
                            <div class="text-box">
                                <h4 class="icon-title mbr-black mbr-fonts-style display-7">
                                    <strong>Créer votre boutique</strong></h4>
                                <h5 class="icon-text mbr-black mbr-fonts-style display-4">Vous accédez à la plateforme
                                    et
                                    vous créez votre boutique en remplissant le formulaire correctement.</h5>
                            </div>
                        </div>
                        <div class="item mbr-flex">
                            <div class="icon-box">
                                <span class="mbr-iconfont mobi-mbri-update mobi-mbri"></span>
                            </div>
                            <div class="text-box">
                                <h4 class="icon-title mbr-black mbr-fonts-style display-7">
                                    <strong>Ajouter vos produits</strong></h4>
                                <h5 class="icon-text mbr-black mbr-fonts-style display-4">Accédez à votre boutique et
                                    renseignez le catalogue.</h5>
                            </div>
                        </div>
                        <div class="item mbr-flex">
                            <div class="icon-box">
                                <span class="mbr-iconfont mobi-mbri-user-2 mobi-mbri"></span>
                            </div>
                            <div class="text-box">
                                <h4 class="icon-title mbr-black mbr-fonts-style display-7">
                                    <strong>Partager votre boutique</strong></h4>
                                <h5 class="icon-text mbr-black mbr-fonts-style display-4">Partager votre boutique avec
                                    les
                                    autres pour une meilleure visibilité.</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section data-bs-version="5.1" class="content4 cid-sIq8PMNs4P" id="content4-g">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="title col-md-12 col-lg-10">
                        <h4 class="mbr-section-subtitle align-center mbr-fonts-style mb-4 display-5">Découvrir les
                            boutiques
                            actuellement ouvertes sur Katalog.<br></h4>
                    </div>
                </div>
            </div>
        </section>
        <section class="form cid-sIq8WSpK6D" id="formbuilder-h">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                        <!--Formbuilder Form-->
                        <form action="https://mobirise.eu/" method="POST" class="mbr-form form-with-styler"
                            data-form-title="boutiqueSearchForm"><input type="hidden" name="email"
                                data-form-email="true"
                                value="ZETOhKJ0dZ5yigHW7pBuepNLB4S5EAntDnTivaIJAtIaCDYW/Ng/0tz2jY+FR60ZVTFqYx5AmWiFZTrx44xJZKnieRU7g6wC+gHkZXYEQ2QcoZdqPeXboTrr1dV1SXNZ.iJIR9v/NotPY62A1L7s06iPPfxxXDPNkoevDwzTWE9J+3cJhvBhmiN/uR5tB1oLPsiRaQdmZIa6JHFIJ6GDRp+Kc/48PlD3asGzDXtFb5jeYzcPshYwu+lTItIaJ6bco">
                            <div class="form-row">
                                <div hidden="hidden" data-form-alert="" class="alert alert-success col-12"></div>
                                <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">
                                    Oops...!
                                    some problem!</div>
                            </div>
                            <div class="dragArea form-row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h5 class="mbr-fonts-style display-5">Rechercher une boutique</h5>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                </div>
                                <div data-for="nom" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="nom-formbuilder-h"
                                        class="form-control-label mbr-fonts-style display-7">Nom
                                        boutique</label>
                                    <input type="text" name="nom" placeholder="Nom de la boutique" data-form-field="nom"
                                        class="form-control display-7" required="required" value=""
                                        id="nom-formbuilder-h">
                                </div>
                                <div class="col-auto"><button type="submit" class="btn btn-primary display-7"><span
                                            class="mobi-mbri mobi-mbri-search mbr-iconfont mbr-iconfont-btn"></span>Rechercher</button>
                                </div>
                            </div>
                        </form>
                        <!--Formbuilder Form-->
                    </div>
                </div>
            </div>
        </section>

        <section data-bs-version="5.1" class="team2 cid-sIq8MfDSMW" xmlns="http://www.w3.org/1999/html" id="team2-f">
            <div class="container">
                <div class="row">
                    @foreach ($shops as $shopItem)
                    <div class="col-12 col-lg-6 mt-2">
                        <div class="card">
                            <div class="card-wrapper">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-2">
                                        <div class="image-wrapper">
                                            <a href="{{route('shop.home',['shop'=>$shopItem])}}">
                                                <img style="height: 100%; object-fit: content"
                                                    src="{{ asset('storage/shops/'.$shopItem->logo) }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md" style="border-left: 3px solid white;">
                                        <div class="card-box">
                                            <a href="{{route('shop.home',['shop'=>$shopItem])}}">
                                                <h5 class="card-title mbr-fonts-style m-0 display-5">
                                                    <strong>{{ $shopItem->nom }}</strong>
                                                </h5>
                                                <h6 class="card-subtitle mbr-fonts-style mt-2 mb-1 display-4">
                                                    <b class="category-badge">{{$shopItem->categorie->nom}}
                                                    </b>
                                                </h6>
                                                <p class="mbr-text mbr-fonts-style display-7">
                                                    {{ \Illuminate\Support\Str::limit($shopItem->description, 120, '...') }}
                                                </p>
                                            </a>
                                            <div class="social-row display-7"
                                                style="border-top: 3px solid white; padding-top: 5px;">
                                                @isset($shopItem->facebook)
                                                <div class="soc-item">
                                                    <a href="{{ $shopItem->facebook }}" target="_blank">
                                                        <span class="mbr-iconfont socicon socicon-facebook"></span>
                                                    </a>
                                                </div>
                                                @endisset
                                                @isset($shopItem->twitter)
                                                <div class="soc-item">
                                                    <a href="{{ $shopItem->twitter }}" target="_blank">
                                                        <span class="mbr-iconfont socicon socicon-twitter"></span>
                                                    </a>
                                                </div>
                                                @endisset
                                                @isset($shopItem->instagram)
                                                <div class="soc-item">
                                                    <a href="{{ $shopItem->instagram }}" target="_blank">
                                                        <span class="mbr-iconfont socicon socicon-instagram"></span>
                                                    </a>
                                                </div>
                                                @endisset
                                                @isset($shopItem->linkedin)
                                                <div class="soc-item">
                                                    <a href="{{ $shopItem->linkedin }}" target="_blank">
                                                        <span class="mbr-iconfont socicon-linkedin socicon"></span>
                                                    </a>
                                                </div>
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section data-bs-version="5.1" class="content12 cid-sIqcTJYywr" id="content12-l">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-4">
                        <div class="mbr-section-btn align-center">
                            @if ($shops->currentPage()!=1)
                            <a class="btn btn-success display-4" href="{{$shops->prevPage()}}"><span
                                    class="mbri-left mbr-iconfont mbr-iconfont-btn"
                                    style="color: rgb(220, 143, 29);"></span>Précédent</a>
                            @endif
                            @if ($shops->currentPage()!=$shops->lastPage())
                            <a class="btn btn-success display-4" href="{{ $shops->nextPage() }}"><span
                                    class="mbri-right mbr-iconfont mbr-iconfont-btn"
                                    style="color: rgb(220, 143, 29);"></span>Suivant</a></div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section data-bs-version="5.1" class="content6 cid-sIqdBA3T3C" id="content6-m">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-10">
                        <hr class="line">
                        <p class="mbr-text align-center mbr-fonts-style my-4 display-5">
                            <em>Envie d'en savoir davantage ? Prenez contact dès aujourd'hui en envoyant un message
                                juste en
                                remplissant le formulaire ci-dessous.</em></p>
                        <hr class="line">
                    </div>
                </div>
            </div>
        </section>

        <section data-bs-version="5.1" class="form1 cid-sIqbbpAaB5" id="form01-j">
            <div class="container">
                <div class="mbr-section-head">
                    <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-5">Envoyer un message</h3>
                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-8 mx-auto" data-form-type="formoid">
                        <!--Formbuilder Form-->
                        <form action="https://mobirise.eu/" method="POST" class="mbr-form form-with-styler"
                            data-form-title="Contact Form"><input type="hidden" name="email" data-form-email="true"
                                value="RgLf7/b9VdMQzVt6GK3iwLM4ToNDUS1Le7ePU62b2qcU5vIqJNv6OIqN6Scn9DwoWe0Iek1HyXjlk67vr2z8OYyv7jcCMrURiaB+M1E8PFgw3h5qkKtXYdanXCf4PYgI.J+N4wtaV8x27zWuU98qu1V4oupNHSG/c6QxdB84bx0C5TR/eVuTLrhT07GAAtsYCFVZ9jpnYhYArD/ebKxft4EU2SZH5GuYead3gySjQfZgXOr06wi203qExqw+FCM//">
                            <div class="row">
                                <div hidden="hidden" data-form-alert="" class="alert alert-success col-12">Merci de nous
                                    avoir contacté, nous allons vous revenir.</div>
                                <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">
                                    Oops...!
                                    some problem!</div>
                            </div>
                            <div class="dragArea row">
                                <div class="col form-group mb-3" data-for="fullName">
                                    <label for="fullName-form01-j"
                                        class="form-control-label mbr-fonts-style display-7"><strong>Nom
                                            complet</strong></label>
                                    <input type="text" name="fullName" placeholder="Nom Complet"
                                        data-form-field="fullName" required="required" class="form-control display-7"
                                        value="" id="fullName-form01-j">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="emailOrPhone">
                                    <label for="emailOrPhone-form01-j"
                                        class="form-control-label mbr-fonts-style display-7"><strong>Email ou
                                            téléphone</strong></label>
                                    <input type="text" name="emailOrPhone" placeholder="Email ou téléphone"
                                        data-form-field="emailOrPhone" required="required"
                                        class="form-control display-7" value="" id="emailOrPhone-form01-j">
                                </div>
                                <div data-for="objet" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="objet-form01-j"
                                        class="form-control-label mbr-fonts-style display-7"><strong>Objet</strong></label>
                                    <input type="text" name="objet" placeholder="Objet du message"
                                        data-form-field="objet" class="form-control display-7" required="required"
                                        value="" id="objet-form01-j">
                                </div>
                                <div data-for="message" class="col-12 form-group mb-3">
                                    <label for="message-form01-j"
                                        class="form-control-label mbr-fonts-style display-7"><strong>Message</strong></label>
                                    <textarea name="message" placeholder="Message" data-form-field="message"
                                        required="required" class="form-control display-7"
                                        id="message-form01-j"></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn"><button
                                        type="submit" class="btn btn-success display-4">Envoyer le message</button>
                                </div>
                            </div>
                        </form>
                        <!--Formbuilder Form-->
                    </div>
                </div>
            </div>
        </section>

        <section data-bs-version="5.1" class="social1 cid-sIqcmgx4Lt" id="share1-k">
            <div class="container">
                <div class="media-container-row">
                    <div class="col-12">
                        <h3 class="mbr-section-title mb-3 align-center mbr-fonts-style display-5">
                            <strong>Partager cette page !</strong>
                        </h3>
                        <div>
                            <div class="mbr-social-likes align-center">
                                <span class="btn btn-social socicon-bg-facebook facebook m-2">
                                    <i class="socicon socicon-facebook"></i>
                                </span>
                                <span class="btn btn-social twitter socicon-bg-twitter m-2">
                                    <i class="socicon socicon-twitter"></i>
                                </span>
                                <span class="btn btn-social vkontakte socicon-bg-vkontakte m-2">
                                    <i class="socicon socicon-vkontakte"></i>
                                </span>
                                <span class="btn btn-social odnoklassniki socicon-bg-odnoklassniki m-2">
                                    <i class="socicon socicon-odnoklassniki"></i>
                                </span>
                                <span class="btn btn-social pinterest socicon-bg-pinterest m-2">
                                    <i class="socicon socicon-pinterest"></i>
                                </span>
                                <span class="btn btn-social mailru socicon-bg-mail m-2">
                                    <i class="socicon socicon-mail"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@auth
@if(auth()->user()->type=='owner')
<a href="{{route('shop.home',['shop'=>auth()->user()->shop])}}" class="btn btn-secondary"
    style="position: fixed; top: 25%; right: 50px;">
    {{auth()->user()->shop->nom}}
</a>
@endif
@endauth
@endsection