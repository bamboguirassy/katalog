<!DOCTYPE html>
<html lang="{{config('app.locale')}}" ng-app="Katalog">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    @if (isset($shop))
    <link rel="shortcut icon" href="{{ asset('storage/shops/'.$shop->logo) }}" type="image/x-icon">
    @else
    <link rel="shortcut icon" href="{{ asset('assets/images/bambogroup.jpg') }}" type="image/x-icon">
    @endif
    <meta name="description" content="@yield('description')">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/web/assets/mobirise-icons2/mobirise2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/assets/mobirise-icons/mobirise-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/Material-Design-Icons/css/material.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/FontAwesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/chatbutton/floating-wpp.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dropdown/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/socicon/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables/vanilla-dataTables.min.css') }}">
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
    <link rel="apple-touch-icon" href="{{ asset('storage/shops/'.$shop->logo) }}">
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
    <section>
        <section data-bs-version="5.1" class="extMenu3 menu cid-sIw8J1nqbg" once="menu" id="extMenu3-1p">
            <nav class="navbar navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
                <div class="menu-content-top">
                    <div class="menu-logo">
                        <div class="navbar-brand">
                            <span class="navbar-logo">
                                @isset($shop)
                                <a href="{{route('shop.home',compact('shop'))}}">
                                    <img src="{{ asset('storage/shops/'.$shop->logo) }}" alt="" style="height: 4rem;">
                                </a>
                                @else
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('assets/images/bambogroup.jpg') }}" alt="" style="height: 4rem;">
                                </a>
                                @endisset
                            </span>
                            @if(isset($shop))
                            <span class="navbar-caption-wrap"><a href="{{ route('shop.home',compact('shop')) }}"
                                    class="brand-link mbr-white display-5">
                                    {{$shop->nom}}
                                </a></span>
                            @else
                            <span class="navbar-caption-wrap">
                                <a href="{{ route('home') }}" class="brand-link mbr-white display-5">
                                    {{config('app.name')}}
                                </a></span>
                            @endif
                        </div>
                    </div>
                    @isset($shop)
                    <div class="menu-content-right">
                        <div class="info-widget">
                            <span class="widget-icon mbr-iconfont mbri-mobile2"
                                style="color: rgb(220, 143, 29); fill: rgb(220, 143, 29);"></span>
                            <div class="widget-content display-4">
                                <p class="widget-title mbr-fonts-style display-4"><a class="mbr-white"
                                        href="tel:{{$shop->telephonePrimaire}}">{{$shop->telephonePrimaire}}</a></p>
                                <p class="widget-text mbr-fonts-style display-4"><a class="mbr-white"
                                        href="tel:{{$shop->telephoneSecondaire}}">{{ $shop->telephoneSecondaire }}</a>
                                </p>
                            </div>
                        </div>
                        <div class="info-widget">
                            <span class="widget-icon mbr-iconfont mobi-mbri-map-pin mobi-mbri"
                                style="color: rgb(220, 143, 29); fill: rgb(220, 143, 29);"></span>
                            <div class="widget-content display-4">
                                <p class="widget-title mbr-fonts-style display-4">{{ $shop->adresse }}</p>
                            </div>
                        </div>
                    </div>
                    @endisset
                </div>
                <div class="menu-bottom">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav nav-dropdown js-float-line nav-right" data-app-modern-menu="true">
                            @if (!isset($shop))
                            <li class="nav-item">
                                <a class="nav-link link mbr-black text-danger text-primary display-4"
                                    href="{{ route('home') }}">
                                    <span class="mobi-mbri mobi-mbri-home mbr-iconfont mbr-iconfont-btn"></span>
                                    {{config('app.name')}}
                                </a>
                            </li>
                            @endif
                            @isset($shop)
                            <li class="nav-item">
                                <a class="nav-link link mbr-black text-danger text-primary display-4"
                                    href="{{ route('shop.home',compact('shop')) }}">
                                    <span
                                        class="mobi-mbri mobi-mbri-shopping-bag mbr-iconfont mbr-iconfont-btn"></span>Accueil</a>
                            </li>
                            @auth
                            @if(auth()->user()->type=='owner')
                            <li class="nav-item"><a class="nav-link link mbr-black text-danger text-primary display-4"
                                    href="{{route('shop.catalogue',compact('shop'))}}"><span
                                        class="mobi-mbri mobi-mbri-bulleted-list mbr-iconfont mbr-iconfont-btn"></span>Catalogue</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link mbr-black text-danger text-primary display-4"
                                    href="{{ route('shop.commande.index',compact('shop')) }}"><span
                                        class="mobi-mbri mobi-mbri-folder mbr-iconfont mbr-iconfont-btn"></span>Commandes</a>
                            </li>
                            @endif
                            @endauth
                            <li class="nav-item">
                                <a class="nav-link link mbr-black text-danger text-primary display-4"
                                    href="{{ route('shop.details', compact('shop')) }}"><span
                                        class="mobi-mbri mobi-mbri-info mbr-iconfont mbr-iconfont-btn"></span>A
                                    propos</a>
                            </li>
                            @endisset
                            @auth
                            @if (auth()->user()->type=='client')
                            <li class="nav-item"><a class="nav-link link mbr-black text-danger text-primary display-4"
                                    href="{{ route('user.commande.list') }}"><span
                                        class="mobi-mbri mobi-mbri-to-local-drive mbr-iconfont mbr-iconfont-btn"></span>Mes
                                    commandes</a></li>
                            @endif
                            <li class="nav-item">
                                <form method="POST" action="{{route('logout')}}" style="display: inline"
                                    class="nav-link link">
                                    @csrf
                                    @method('post')
                                    <button style="border: none;padding: 0!important; display: inline;" type="submit"
                                        class="mbr-black text-danger text-primary display-4"><span
                                            class="mobi-mbri mobi-mbri-arrow-down mbr-iconfont mbr-iconfont-btn"></span>
                                        Déconnexion</button>
                                </form>
                            </li>
                            @endauth
                            @guest
                            <li class="nav-item">
                                <a class="nav-link link mbr-black text-danger text-primary display-4"
                                    href="infos-boutique.html" data-toggle="modal" data-bs-toggle="modal"
                                    data-target="#mbr-popup-1f" data-bs-target="#mbr-popup-1f"><span
                                        class="mobi-mbri mobi-mbri-user mbr-iconfont mbr-iconfont-btn"></span>Se
                                    connecter</a>
                            </li>
                            @endguest
                        </ul>

                    </div>
                    <button class="navbar-toggler " type="button" data-toggle="collapse" data-bs-toggle="collapse"
                        data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <div class="hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>
                </div>
            </nav>
        </section>
        <section>
            @yield('body')
            @include('user.login')
            @include('user.register')
            @include('shop.produit.add-panier-temp')
        </section>

        {{-- panier client --}}
        @auth
        @if (auth()->user()->type=='client' && isset($shop))
        <a href="{{ route('shop.panier.retrieve',compact('shop')) }}" class="btn btn-secondary"
            style="position: fixed; top: 25%; right: 20px;">
            <span class="mbr-iconfont mbri-shopping-cart"></span> PANIER
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

        <div id="chatbutton-wa" data-phone="+221778224129" data-showpopup="true"
            data-headertitle="👋 Chatons sur WhatsApp !" data-popupmessage="Salut!👋
        Laisse nous un message si tu as besoin d'assistance ou de plus d'information ! 🔥
        Bambo GROUP" data-placeholder="Ecrire ici..." data-position="left" data-headercolor="#39847a"
            data-backgroundcolor="#e5ddd5" data-autoopentimeout="0" data-size="65px">
            <div class="floating-wpp-button" style="width: 65px; height: 65px;">
                <div class="floating-wpp-button-image">
                    <!--?xml version="1.0" encoding="UTF-8" standalone="no"?--><svg xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" style="isolation:isolate" viewBox="0 0 800 800"
                        width="65" height="65">
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
    </section>

    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/smoothscroll/smooth-scroll.js') }}"></script>
    <script src="{{ asset('assets/ytplayer/index.js') }}"></script>
    <script src="{{ asset('assets/chatbutton/floating-wpp.js') }}"></script>
    <script src="{{ asset('assets/chatbutton/script.js') }}"></script>
    <script src="{{ asset('assets/dropdown/js/navbar-dropdown.js') }}"></script>
    <script src="{{ asset('assets/touchswipe/jquery.touch-swipe.min.js') }}"></script>
    <script src="{{ asset('assets/popup-plugin/script.js') }}"></script>
    <script src="{{ asset('assets/popup-overlay-plugin/script.js') }}"></script>
    <script src="{{ asset('assets/sociallikes/social-likes.js') }}"></script>
    <script src="{{ asset('assets/datatables/vanilla-dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/theme/js/script.js') }}"></script>
    <script src="{{ asset('assets/formoid.min.js') }}"></script>
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>
    <script src="{{ asset('bower_components/angular-filter/dist/angular-filter.min.js') }}"></script>
    <script src="{{ asset('angular/app.js') }}"></script>
    <script src="{{ asset('angular/controllers/main.controller.js') }}"></script>
    <script src="{{ asset('angular/controllers/shop.new.controller.js') }}"></script>
</body>

</html>