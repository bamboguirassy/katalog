@extends('base')

@section('title',"Katalog");

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
                            <br>
                            <h1 class="mbr-section-title align-left mbr-fonts-style mb-4"
                                data-app-selector=".mbr-section-title" mbr-theme-style="display-2" mbr-if="showTitle">
                                Bienvenue sur <b>{{ config('app.name') }}</b></h1>
                            <p class="mbr-text align-left mbr-fonts-style display-5">
                                Votre plateforme de vente pour booster votre commerce et augmenter votre visibilité.
                                Simplifiez vos statuts WhatsApp,
                                Instagram, Facebook et gérer votre catalogue et vos commandes en un seul et unique
                                endroit.</p>
                            <div class="mbr-section-btn mt-4">
                                @guest
                                <a class="btn btn-secondary display-7" href="{{ route('shop.new') }}"><span
                                        class="mobi-mbri mobi-mbri-arrow-next mbr-iconfont mbr-iconfont-btn"></span>Essayez
                                    gratuitement</a>
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
                                            style="color: #1C73BA;"></span>Essayez gratuitement votre boutique&nbsp;</a>
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
                    <div class="col-lg-8 mx-auto mbr-form">
                        <!--Formbuilder Form-->
                        <form action="{{ route('shop.search') }}" method="POST" class="mbr-form form-with-styler"
                            data-form-title="boutiqueSearchForm">
                            @csrf
                            @method('post')
                            {{-- <div class="form-row">
                                @foreach ($errors->all() as $message)
                                <div data-form-alert-danger="" class="alert alert-danger col-12">
                                    {{$message}}
                                </div>
                                @endforeach
                            </div> --}}
                            {{-- <div class="dragArea form-row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h5 class="mbr-fonts-style display-5">Accéder à une boutique</h5>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                </div>
                                <div data-for="pseudonyme" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <input type="text" name="pseudonyme" placeholder="Code ou pseudonyme de la boutique"
                                        data-form-field="pseudonyme" class="form-control display-7" required="required"
                                        value="" id="pseudonyme-formbuilder-h">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary display-7">
                                        <span
                                            class="mobi-mbri mobi-mbri-arrow-next mbr-iconfont mbr-iconfont-btn"></span>
                                        Ouvrir</button>
                                </div>
                            </div> --}}
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
                                    <div class="col-12 col-md-2"
                                        style="border: 2px solid #1c73ba; border-bottom: 2px solid white;">
                                        <div class="image-wrapper">
                                            <a href="{{route('shop.home',['shop'=>$shopItem])}}">
                                                <img src="{{ asset('uploads/shops/'.$shopItem->logo) }}" alt="">
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

@section('more')
<div id="chatbutton-wa" data-phone="+221778224129" data-showpopup="true" data-headertitle="👋 Chatons sur WhatsApp !"
    data-popupmessage="Salut!👋
Laisse nous un message si tu as besoin d'assistance ou de plus d'information ! 🔥
Bambo GROUP" data-placeholder="Ecrire ici..." data-position="left" data-headercolor="#39847a"
    data-backgroundcolor="#e5ddd5" data-autoopentimeout="0" data-size="65px">
    <div class="floating-wpp-button" style="width: 65px; height: 65px;">
        <div class="floating-wpp-button-image">
            <!--?xml version="1.0" encoding="UTF-8" standalone="no"?--><svg xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" style="isolation:isolate" viewBox="0 0 800 800" width="65"
                height="65">
                <defs>
                    <clipPath id="_clipPath_A3g8G5hPEGG2L0B6hFCxamU4cc8rfqzQ">
                        <rect width="800" height="800"></rect>
                    </clipPath>
                </defs>
                <g clip-path="url(#_clipPath_A3g8G5hPEGG2L0B6hFCxamU4cc8rfqzQ)">
                    <g>
                        <path
                            d=" M 787.59 800 L 12.41 800 C 5.556 800 0 793.332 0 785.108 L 0 14.892 C 0 6.667 5.556 0 12.41 0 L 787.59 0 C 794.444 0 800 6.667 800 14.892 L 800 785.108 C 800 793.332 794.444 800 787.59 800 Z "
                            fill="rgb(37,211,102)"></path>
                    </g>
                    <g>
                        <path
                            d=" M 508.558 450.429 C 502.67 447.483 473.723 433.24 468.325 431.273 C 462.929 429.308 459.003 428.328 455.078 434.22 C 451.153 440.114 439.869 453.377 436.434 457.307 C 433 461.236 429.565 461.729 423.677 458.78 C 417.79 455.834 398.818 449.617 376.328 429.556 C 358.825 413.943 347.008 394.663 343.574 388.768 C 340.139 382.873 343.207 379.687 346.155 376.752 C 348.804 374.113 352.044 369.874 354.987 366.436 C 357.931 362.999 358.912 360.541 360.875 356.614 C 362.837 352.683 361.857 349.246 360.383 346.299 C 358.912 343.352 347.136 314.369 342.231 302.579 C 337.451 291.099 332.597 292.654 328.983 292.472 C 325.552 292.301 321.622 292.265 317.698 292.265 C 313.773 292.265 307.394 293.739 301.996 299.632 C 296.6 305.527 281.389 319.772 281.389 348.752 C 281.389 377.735 302.487 405.731 305.431 409.661 C 308.376 413.592 346.949 473.062 406.015 498.566 C 420.062 504.634 431.03 508.256 439.581 510.969 C 453.685 515.451 466.521 514.818 476.666 513.302 C 487.978 511.613 511.502 499.06 516.409 485.307 C 521.315 471.55 521.315 459.762 519.842 457.307 C 518.371 454.851 514.446 453.377 508.558 450.429 Z  M 401.126 597.117 L 401.047 597.117 C 365.902 597.104 331.431 587.661 301.36 569.817 L 294.208 565.572 L 220.08 585.017 L 239.866 512.743 L 235.21 505.332 C 215.604 474.149 205.248 438.108 205.264 401.1 C 205.307 293.113 293.17 205.257 401.204 205.257 C 453.518 205.275 502.693 225.674 539.673 262.696 C 576.651 299.716 597.004 348.925 596.983 401.258 C 596.939 509.254 509.078 597.117 401.126 597.117 Z  M 567.816 234.565 C 523.327 190.024 464.161 165.484 401.124 165.458 C 271.24 165.458 165.529 271.161 165.477 401.085 C 165.46 442.617 176.311 483.154 196.932 518.892 L 163.502 641 L 288.421 608.232 C 322.839 627.005 361.591 636.901 401.03 636.913 L 401.126 636.913 L 401.127 636.913 C 530.998 636.913 636.717 531.2 636.77 401.274 C 636.794 338.309 612.306 279.105 567.816 234.565"
                            fill-rule="evenodd" fill="rgb(255,255,255)"></path>
                    </g>
                </g>
            </svg>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/chatbutton/floating-wpp.js') }}"></script>
<script src="{{ asset('assets/chatbutton/script.js') }}"></script>
@endsection