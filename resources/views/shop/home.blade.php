@extends('base')

@section('title',$shop->nom);

@section('twitter-title', $shop->nom)

@section('description',$shop->description)

@section('body')
<div class="row">
    <div class="col-12" style="padding: 0px;">
        <section data-bs-version="5.1" class="extHeader cid-sIpKoQ30mN" id="extHeader21-3">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1380px"
                height="760px" viewBox="0 0  1380 760" preserveAspectRatio="xMidYMid meet">
                <rect id="svgEditorBackground" x="0" y="0" width="1380" height="760" style="fill: none; stroke: none;">
                </rect>
                <ellipse id="e1_ellipse" cx="411" cy="-89" style="fill:khaki;stroke:black;stroke-width:0px;" rx="842"
                    ry="677" transform="matrix(1.10937 0 0 1.10937 -41.7954 -68.1567)"></ellipse>
            </svg>

            <div class="container align-center">
                <div class="row">
                    <div class="col-md-12 col-lg-6 py-4 m-auto">
                        <h1 class="mbr-section-title mbr-regular pb-3 align-left mbr-fonts-style display-1">
                            {{$shop->nom}}</h1>

                        <p class="mbr-text mbr-light pb-3 align-left mbr-fonts-style display-7">
                            {{$shop->description}}
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-12 align-center">
                        <div class="img-box">
                            @isset($shop->logo)
                            <img style="width: 250px; height: 250px;" src="{{ asset('uploads/shops/'.$shop->logo) }}" alt="">
                            @else
                            <img style="max-height: 300px;" src="{{ asset('assets/images/votre-logo-ici.png') }}" alt="">
                            @endisset
                        </div>
                    </div>
                </div>

            </div>
        </section>
        {{-- start main categories products list --}}
        @if ($produits->currentPage()==1)
        @foreach ($categories as $categorie)
        @if ($categorie->produits_count>2)
        <section data-bs-version="5.1" class="info3 cid-sIvpc3K9D7" id="info3-1o">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="card col-12">
                        <div class="card-wrapper">
                            <div class="card-box align-left" style="font-size: 23px;">
                                <a
                                    href="{{ route('shop.categorie.show',compact('shop','categorie')) }}"><strong> >>
                                        {{$categorie->nom}} </strong></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section data-bs-version="5.1" class="gallery1 cid-sIpMwjCas3" id="gallery1-8">
            <div class="container">
                <div class="row content-margin">
                    @foreach ($categorie->produits as $produit)
                    <x-produit-item :produit="$produit" :paProduits="$paProduits" :shop="$shop" />
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12 align-right">
                        <a href="{{ route('shop.categorie.show',compact('shop','categorie')) }}"
                            class="btn btn-secondary">Voir plus > </a>
                    </div>
                </div>
            </div>
        </section>
        @endif
        @endforeach
        @endif
        {{-- fin main category products list --}}

        {{-- start all section products --}}

        <section data-bs-version="5.1" class="info3 cid-sIvpc3K9D7" id="info3-1o">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="card col-12">
                        <div class="card-wrapper">
                            <div class="card-box">
                                <div class="mbr-text mbr-fonts-style display-4">
                                    Retrouvez tous nos articles disponibles. @if ($produits->currentPage()!=1)
                                    <span>Page {{$produits->currentPage()}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section data-bs-version="5.1" class="gallery1 cid-sIpMwjCas3 pt-1" id="gallery1-8">
            <div class="container">
                <div class="mbr-section-head mb-0">
                    <h5 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 display-7">
                        Découvrez notre catalogue de produits. Ajoutez vos produits dans le panier et validez votre
                        panier.</h5>
                </div>
                <div class="row mt-0 content-margin">
                    @foreach ($produits as $produit)
                    <x-produit-item :produit="$produit" :paProduits="$paProduits" :shop="$shop" />
                    @endforeach
                    <div class="col-12">
                        @if ($produits->currentPage()!=1)
                        <a href="{{ $produits->previousPageUrl() }}" class="btn btn-secondary pull-left ml-2">Page
                            précédente</a>
                        @endif
                        @if ($produits->currentPage()!=$produits->lastPage())
                        <a href="{{ $produits->nextPageUrl() }}" class="btn btn-secondary pull-right mr-2">Page
                            suivante</a>
                        @endif
                    </div>
                    @if (count($produits)<1) <h3 class="text-center" style="background: white;">La boutique ne contient
                        aucun produit pour le moment !</h3>
                        @endif
                </div>
            </div>
        </section>
        {{-- end all product page --}}
        <section data-bs-version="5.1" class="social-buttons02 creativem4_social-buttons02 cid-sIpLx9ZEd5"
            id="social-buttons02-6">
            <div class="container">
                <div class="row justify-content-center">
                    @isset($shop->facebook)
                    <div class="card cardcolor p-3 col-12 col-md-6 col-lg-3">
                        <div class="card-wrapper">
                            <div class="card-img">
                                <a rel="noreferrer" href="{{$shop->facebook}}"><span class="mbr-iconfont ico1 socicon-facebook socicon"
                                        style="color: rgb(68, 121, 217); fill: rgb(68, 121, 217);"></span></a>
                            </div>
                            <div class="card-box">
                                <h3 class="card-title align-left mbr-fonts-style display-5">
                                    <a rel="noreferrer"
                                        href="{{$shop->facebook}}" class="text-primary">Facebook</a></h3>
                                <h4 class="mbr-text align-left mbr-fonts-style display-4">
                                    PAGE</h4>
                            </div>
                            <div class="card-img">
                                <a rel="noreferrer" href="{{$shop->facebook}}"><span
                                        class="mbr-iconfont ico2 mobi-mbri-right mobi-mbri"></span></a>
                            </div>
                        </div>
                    </div>
                    @endisset
                    @isset($shop->linkedin)
                    <div class="card cardcolor p-3 col-12 col-md-6 col-lg-3">
                        <div class="card-wrapper">
                            <div class="card-img">
                                <a rel="noreferrer" href="{{$shop->linkedin}}"><span class="mbr-iconfont ico1 socicon-linkedin socicon"
                                        style="color: rgb(28, 115, 186); fill: rgb(28, 115, 186);"></span></a>
                            </div>
                            <div class="card-box">
                                <h3 class="card-title align-left mbr-fonts-style display-5"><a rel="noreferrer"
                                        href="{{$shop->linkedin}}" class="text-primary">LinkedIn</a></h3>
                                <h4 class="mbr-text align-left mbr-fonts-style display-4">
                                    PAGE</h4>
                            </div>
                            <div class="card-img">
                                <a rel="noreferrer" href="{{$shop->linkedin}}"><span
                                        class="mbr-iconfont ico2 mobi-mbri-right mobi-mbri"></span></a>
                            </div>
                        </div>
                    </div>
                    @endisset
                    @isset($shop->twitter)
                    <div class="card cardcolor p-3 col-12 col-md-6 col-lg-3">
                        <div class="card-wrapper">
                            <div class="card-img">
                                <a rel="noreferrer" href="{{$shop->twitter}}"><span class="mbr-iconfont ico1 socicon-twitter socicon"
                                        style="color: rgb(85, 128, 255); fill: rgb(85, 128, 255);"></span></a>
                            </div>
                            <div class="card-box">
                                <h3 class="card-title align-left mbr-fonts-style display-5"><a rel="noreferrer" href="{{$shop->twitter}}"
                                        class="text-primary">Twitter</a>
                                </h3>
                                <h4 class="mbr-text align-left mbr-fonts-style display-4">
                                    NEWS FEED</h4>
                            </div>
                            <div class="card-img">
                                <a rel="noreferrer" href="{{$shop->twitter}}"><span
                                        class="mbr-iconfont ico2 mobi-mbri-right mobi-mbri"></span></a>
                            </div>
                        </div>
                    </div>
                    @endisset
                    @isset($shop->instagram)
                    <div class="card cardcolor p-3 col-12 col-md-6 col-lg-3">
                        <div class="card-wrapper">
                            <div class="card-img">
                                <a rel="noreferrer" href="{{$shop->instagram}}"><span class="mbr-iconfont ico1 socicon-instagram socicon"
                                        style="color: rgb(255, 138, 115); fill: rgb(255, 138, 115);"></span></a>
                            </div>
                            <div class="card-box">
                                <h3 class="card-title align-left mbr-fonts-style display-5"><a
                                    rel="noreferrer" href="{{$shop->instagram}}" class="text-primary">Instagram</a></h3>
                                <h4 class="mbr-text align-left mbr-fonts-style display-4">
                                    PHOTO</h4>
                            </div>
                            <div class="card-img">
                                <a rel="noreferrer" href="{{$shop->instagram}}"><span
                                        class="mbr-iconfont ico2 mobi-mbri-right mobi-mbri"></span></a>
                            </div>
                        </div>
                    </div>
                    @endisset
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
        <section data-bs-version="5.1" class="social1 cid-sIpMTfwPPF" id="share1-a">
            <div class="container">
                <div class="media-container-row">
                    <div class="col-12">
                        <h3 class="mbr-section-title mb-3 align-center mbr-fonts-style display-5">
                            <strong>Partager cette boutique sur</strong></h3>
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
@endsection