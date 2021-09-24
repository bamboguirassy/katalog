<!DOCTYPE html>
<html lang="{{config('app.locale')}}" ng-app="Katalog">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    @if (isset($shop))
    <link rel="shortcut icon" href="{{ asset('uploads/shops/'.$shop->logo) }}" type="image/x-icon">
    @else
    <link rel="shortcut icon" href="{{ asset('assets/images/bambogroup.jpg') }}" type="image/x-icon">
    @endif
    <meta name="description" content="@yield('description')">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/web/assets/mobirise-icons2/mobirise2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/assets/mobirise-icons/mobirise-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/Material-Design-Icons/css/material.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/FontAwesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/chatbutton/floating-wpp.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dropdown/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/socicon/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/recaptcha.css') }}">
    <link rel="preload"
        href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap">
    </noscript>
    <link rel="preload" as="style" href="{{ asset('assets/mobirise/css/mbr-additional.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/mobirise/css/mbr-additional.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('bower_components/angular-auto-complete/angular-auto-complete.css') }}">
    <meta name="theme-color" content="#196b86">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <script src="{{ asset('sw-connect.js') }}"></script>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-startup-image"
        media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="{{ asset('assets/images/apple-launch-640x1136.png') }}">
    <link rel="apple-touch-startup-image"
        media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="{{ asset('assets/images/apple-launch-750x1334.png') }}">
    <link rel="apple-touch-startup-image"
        media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
        href="{{ asset('assets/images/apple-launch-1242x2208.png') }}">
    <link rel="apple-touch-startup-image"
        media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
        href="{{ asset('assets/images/apple-launch-1125x2436.png') }}">
    <link rel="apple-touch-startup-image"
        media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="{{ asset('assets/images/apple-launch-1536x2048.png') }}">
    <link rel="apple-touch-startup-image"
        media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="{{ asset('assets/images/apple-launch-1668x2224.png') }}">
    <link rel="apple-touch-startup-image"
        media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="{{ asset('assets/images/apple-launch-2048x2732.png') }}">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Katalog">
    @if (isset($shop))
    <link rel="apple-touch-icon" href="{{ asset('uploads/shops/'.$shop->logo) }}">
    @else
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    @endif
</head>

<body ng-controller="MainController">
    @auth
    <span ng-init="setCurrentUser({{auth()->user()}})"></span>
    @endauth
    @isset($shop)
    <span ng-init="setCurrentShop({{$shop}})"></span>
    @endisset
    <section data-bs-version="5.1" class="menu menu1 cid-sJc9pEj434" once="menu" id="menu1-3w">
        <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
            <div class="menu-tite mbr-fonts-style display-4 text-white">
                <div>
                    @isset($shop)
                    <input ng-model="produitName" auto-complete="produitAutoCompleteOptions"
                        style="max-width: 500px; display: inline;" class="form-control" type="text" name="saerch"
                        id="searchProduit" placeholder="Rechercher un produit">
                    @else
                    <input ng-model="shopName" auto-complete="shopAutoCompleteOptions"
                        style="max-width: 500px; display: inline;" class="form-control" type="text" name="saerch"
                        id="searchShop" placeholder="Rechercher une boutique">
                    @endisset
                </div>
            </div>
            {{-- <h3 class="menu-tite mbr-fonts-style display-4 text-white">
                    <strong>
                        <a href="{{ route('home') }}" class="mbr-white">{{config('app.name')}}</a>
            </strong>, votre plateforme de proximité pour mieux gérer les
            ventes.</h3> --}}
            <div class="container">

                <div class="navbar-brand">
                    <span class="navbar-logo">
                        @isset($shop)
                        <a href="{{route('shop.home',compact('shop'))}}">
                            <img src="{{ asset('uploads/shops/'.$shop->logo) }}" alt="{{$shop->nom}}"
                                style="height: 3rem;">
                        </a>
                        @else
                        <img src="{{ asset('assets/images/bambogroup.jpg') }}" alt="Logo {{config('app.name')}}">
                        @endisset
                    </span>
                    <span class="navbar-caption-wrap">
                        @isset($shop)
                        <a class="navbar-caption text-primary display-7"
                            href="{{ route('shop.home',compact('shop')) }}">
                            {{$shop->nom}}
                        </a>
                        @else
                        <a class="navbar-caption text-primary display-7"
                            href="{{ route('home') }}">{{config('app.name')}}</a>
                        @endisset
                    </span>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse"
                    data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
                        <li class="nav-item">
                            @isset($shop)
                            <a class="nav-link link text-primary display-4"
                                href="{{ route('shop.home',compact('shop')) }}">
                                <span class="mobi-mbri mobi-mbri-shopping-bag mbr-iconfont mbr-iconfont-btn">
                                </span>Accueil&nbsp;
                            </a>
                            @else
                            <a class="nav-link link text-primary display-4" href="{{route('home')}}">
                                <span class="mobi-mbri mobi-mbri-home mbr-iconfont mbr-iconfont-btn">
                                </span>Accueil&nbsp;
                            </a>
                            @endisset
                        </li>
                        @isset($shop)
                        @if (count($shop->categories)>0)
                        <li class="nav-item dropdown">
                            <a class="nav-link link text-primary dropdown-toggle display-4" href="#"
                                data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                aria-expanded="false">
                                <span class="mobi-mbri mobi-mbri-add-submenu mbr-iconfont mbr-iconfont-btn"></span>
                                Catégories&nbsp;</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                                @foreach ($shop->categories as $categorie)
                                <div class="dropdown">
                                    @if (count($categorie->subs)>0)
                                    <a class="text-primary dropdown-item dropdown-toggle display-4" href="{{ route('shop.categorie.show',['shop'=>$shop,'categorie'=>$categorie]) }}"
                                        data-toggle="dropdown-submenu" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" aria-expanded="false">{{$categorie->nom}}</a>
                                    <div class="dropdown-menu dropdown-submenu" aria-labelledby="dropdown-undefined">
                                        @foreach ($categorie->subs as $sub)
                                        <a class="text-primary dropdown-item display-4" href="{{ route('shop.categorie.show',['shop'=>$shop,'categorie'=>$sub]) }}">{{$sub->nom}}</a>
                                        @endforeach
                                    </div>
                                    @else
                                    <a class="text-primary dropdown-item display-4"
                                        href="{{ route('shop.categorie.show',['shop'=>$shop,'categorie'=>$categorie]) }}"
                                        aria-expanded="false">
                                        {{$categorie->nom}}
                                    </a>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </li>
                        @endif
                        <!-- Menu des marques -->
                        @if (count($shop->marques)>0)
                        <li class="nav-item dropdown">
                            <a class="nav-link link text-primary dropdown-toggle display-4" href="#"
                                aria-expanded="false" data-toggle="dropdown-submenu" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside">
                                <span class="mbrib-features mbr-iconfont mbr-iconfont-btn"></span>
                                Marques
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                                @foreach ($shop->marques as $marque)
                                <a class="text-primary dropdown-item display-4"
                                    href="{{ route('shop.marque.show',compact('shop','marque')) }}" aria-expanded="false">
                                    </span>{{$marque->nom}}
                                </a>
                                @endforeach
                            </div>
                        </li>
                        @endif
                        <!-- end menu marque -->
                        @endisset
                        @auth
                        @isset($shop)
                        @if (auth()->user()->type=='owner' && $shop->user_id==auth()->user()->id)
                        <li class="nav-item dropdown">
                            <a class="nav-link link text-primary dropdown-toggle display-4" href="#"
                                aria-expanded="false" data-toggle="dropdown-submenu" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside">
                                <span class="mbrib-setting3 mbr-iconfont mbr-iconfont-btn"></span>
                                Paramétrage
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                                <a class="text-primary dropdown-item display-4"
                                    href="{{ route('shop.categorie.index',compact('shop')) }}" aria-expanded="false">
                                    <span class="mobi-mbri mobi-mbri-layers mbr-iconfont mbr-iconfont-btn">
                                    </span>Catégories
                                </a>
                                <a class="text-primary dropdown-item display-4"
                                    href="{{ route('shop.marque.index',compact('shop')) }}" aria-expanded="false">
                                    <span class="mobi-mbri mobi-mbri-target mbr-iconfont mbr-iconfont-btn">
                                    </span>Marques
                                </a>
                                <a class="text-primary dropdown-item display-4"
                                    href="{{ route('shop.attribut.index',compact('shop')) }}" aria-expanded="false">
                                    <span class="mobi-mbri mobi-mbri-features mbr-iconfont mbr-iconfont-btn">
                                    </span>Attributs de produits
                                </a>
                                <a class="text-primary dropdown-item display-4"
                                    href="{{ route('shop.details',compact('shop')) }}" aria-expanded="false">
                                    <span class="mobi-mbri mobi-mbri-info mbr-iconfont mbr-iconfont-btn">

                                    </span>
                                    Paramètres boutique
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link link text-primary dropdown-toggle display-4" href="#"
                                aria-expanded="false" data-toggle="dropdown-submenu" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside">
                                <span class="mobi-mbri mobi-mbri-shopping-basket mbr-iconfont mbr-iconfont-btn"></span>
                                Gestion
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                                <a class="text-primary dropdown-item display-4"
                                    href="{{ route('shop.catalogue',compact('shop')) }}" aria-expanded="false">
                                    <span
                                        class="mobi-mbri mobi-mbri-image-gallery mbr-iconfont mbr-iconfont-btn"></span>Catalogue
                                    de produit
                                </a>
                                <a class="text-primary dropdown-item display-4"
                                    href="{{ route('shop.commande.index',compact('shop')) }}" aria-expanded="false">
                                    <span
                                        class="mobi-mbri mobi-mbri-shopping-cart mbr-iconfont mbr-iconfont-btn"></span>
                                    Commandes
                                </a>
                                <a class="text-primary dropdown-item display-4"
                                    href="{{ route('shop.produit.create',compact('shop')) }}" aria-expanded="false">
                                    <span class="mobi-mbri mobi-mbri-plus mbr-iconfont mbr-iconfont-btn"></span>
                                    Ajouter un produit
                                </a>
                            </div>
                        </li>
                        @endif
                        @endisset
                        <li class="nav-item dropdown"><a class="nav-link link text-primary dropdown-toggle display-4"
                                href="#" data-toggle="dropdown-submenu" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" aria-expanded="false">
                                <span class="mobi-mbri mobi-mbri-user mbr-iconfont mbr-iconfont-btn"></span>
                                Mon compte
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                                <a class="text-primary dropdown-item display-4" href="#">
                                    <span class="mobi-mbri mobi-mbri-user-2 mbr-iconfont mbr-iconfont-btn">
                                    </span>Mon profil
                                </a>
                                @if (auth()->user()->type=='client')
                                @isset($shop)
                                <a class="text-primary dropdown-item display-4"
                                    href="{{ route('shop.panier.show',compact('shop')) }}">
                                    <span class="mobi-mbri mobi-mbri-cart-add mbr-iconfont mbr-iconfont-btn">
                                    </span>Mon panier
                                </a>
                                @endisset
                                <a class="text-primary dropdown-item display-4"
                                    href="{{ route('user.commande.list') }}">
                                    <span class="mobi-mbri mobi-mbri-shopping-cart mbr-iconfont mbr-iconfont-btn">
                                    </span>
                                    Mes commandes
                                </a>
                                @endif
                                <a class="text-primary dropdown-item display-4" href="{{ route('logout') }}">
                                    <span class="mobi-mbri mobi-mbri-logout mbr-iconfont mbr-iconfont-btn">
                                    </span>
                                    Déconnexion
                                </a>
                            </div>
                        </li>
                        @endauth
                        @isset($shop)
                        <a class="nav-link link text-primary display-4"
                            href="{{route('shop.details',compact('shop'))}}">
                            <span class="mbrib-contact-form mbr-iconfont mbr-iconfont-btn">
                            </span>Contacts&nbsp;
                        </a>
                        @endisset
                        @guest
                        <a class="nav-link link text-primary display-4" data-toggle="modal" data-bs-toggle="modal"
                            data-target="#mbr-popup-1f" data-bs-target="#mbr-popup-1f">
                            <span class="mobi-mbri mobi-mbri-login mbr-iconfont mbr-iconfont-btn">
                            </span>Se connecter&nbsp;
                        </a>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </section>
    <section ng-cloak>
        <div class="container">
            <div class="col-12">
                @yield('body')
            </div>
        </div>
        @include('user.login')
        @include('user.register')
        @include('shop.produit.add-panier-temp')
    </section>

    {{-- panier client --}}
    @auth
    @if (auth()->user()->type=='client' && isset($shop))
    <a href="/[[shop.pseudonyme]]/panier/show" class="btn btn-info" style="position: fixed; top: 25%; right: 2px;">
        <span class="mbr-iconfont mbri-shopping-cart"></span> ([[panier?panier.produits_count:0]])
        <!--PANIER-->
    </a>
    @endif
    @endauth
    {{-- fin panier client --}}


    <section data-bs-version="5.1" class="footer2 cid-sIpIi9d37Z" once="footers" id="footer02-c">
        <div class="container">
            <div class="media-container-row align-center mbr-white">
                <div class="col-12">
                    <p class="mbr-text mb-0 mbr-fonts-style display-7">
                        © Copyright {{date_format(new DateTime(),'Y')}} <a href="https://bambogroup.net"
                            class="text-danger" target="_blank">Bambo
                            GROUP</a> - Tous droits réservés</p>
                </div>
            </div>
        </div>
    </section>

    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/smoothscroll/smooth-scroll.js') }}"></script>
    <script src="{{ asset('assets/ytplayer/index.js') }}"></script>
    <script src="{{ asset('assets/dropdown/js/navbar-dropdown.js') }}"></script>
    <script src="{{ asset('assets/touchswipe/jquery.touch-swipe.min.js') }}"></script>
    @yield('script')
    <script src="{{ asset('assets/popup-plugin/script.js') }}"></script>
    <script src="{{ asset('assets/popup-overlay-plugin/script.js') }}"></script>
    <script src="{{ asset('assets/sociallikes/social-likes.js') }}"></script>
    <script src="{{ asset('assets/theme/js/script.js') }}"></script>
    <script src="{{ asset('assets/formoid.min.js') }}"></script>
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>
    <script src="{{ asset('bower_components/angular-sanitize/angular-sanitize.min.js') }}"></script>
    <script src="{{ asset('bower_components/lodash/dist/lodash.min.js') }}"></script>
    <script src="{{ asset('bower_components/angular-auto-complete/angular-auto-complete.js') }}"></script>
    <script src="{{ asset('bower_components/angular-filter/dist/angular-filter.min.js') }}"></script>
    <script src="{{ asset('angular/app.js') }}"></script>
    <script src="{{ asset('angular/services/attribut.service.js') }}"></script>
    <script src="{{ asset('angular/services/produit.service.js') }}"></script>
    <script src="{{ asset('angular/services/panier.service.js') }}"></script>
    <script src="{{ asset('angular/controllers/main.controller.js') }}"></script>
    <script src="{{ asset('angular/controllers/shop.new.controller.js') }}"></script>
    <script src="{{ asset('angular/controllers/attribut.controller.js') }}"></script>
    <script src="{{ asset('angular/controllers/produit.new.controller.js') }}"></script>
    <script src="{{ asset('angular/controllers/produit.show.controller.js') }}"></script>
    <script src="{{ asset('angular/controllers/produit.display.controller.js') }}"></script>
    <script src="{{ asset('angular/controllers/panier.controller.js') }}"></script>
    <script src="{{ asset('angular/controllers/categorie.controller.js') }}"></script>
</body>

</html>