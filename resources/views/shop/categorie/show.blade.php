@extends('base')

@section('title',$shop->nom.' '.$categorie->nom.' Liste produits');

@section('description',$shop->description)

@section('body')
<div class="row">
    <div class="col-12">
        <section data-bs-version="5.1" class="extHeader cid-sIpKoQ30mN" id="extHeader21-3">
            <svg class="card-primary" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1380px"
                height="760px" viewBox="0 0  1380 760" preserveAspectRatio="xMidYMid meet">
                <rect id="svgEditorBackground" x="0" y="0" width="1380" height="760" style="fill: none; stroke: none;">
                </rect>
                <ellipse id="e1_ellipse" cx="411" cy="-89" style="fill:khaki;stroke:black;stroke-width:0px;" rx="842"
                    ry="677" transform="matrix(1.10937 0 0 1.10937 -41.7954 -68.1567)"></ellipse>
            </svg>

            <div class="container align-center">
                <div class="row">
                    <div class="col-md-12 col-lg-8 py-1 m-auto">
                        <h1 class="text-primary mbr-section-title mbr-regular pb-1 align-left mbr-fonts-style display-2">
                            {{$shop->nom}} -> {{$categorie->nom}}
                        </h1>
                        <p class="mbr-text mbr-light pb-3 align-left mbr-fonts-style display-7">
                            {{$categorie->description}}
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-12 align-center">
                        <div class="img-box">
                            <a href="{{ route('shop.home',compact('shop')) }}">
                                <img style="max-height: 300px; object-fit: fill;"
                                    src="{{ asset('uploads/shops/'.$shop->logo) }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section data-bs-version="5.1" class="info3 cid-sIvpc3K9D7" id="info3-1o">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="card col-12">
                        <div class="card-wrapper">
                            <div class="card-box align-left" style="font-size: 25px; font-weight: bolder;">
                                @foreach ($categorie->subs as $sub)
                                <span><a
                                        href="{{ route('shop.categorie.show',['shop'=>$shop,'categorie'=>$sub]) }}">{{ $sub->nom }}</a>
                                    >></span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section data-bs-version="5.1" class="gallery1 cid-sIpMwjCas3 card-primary" id="gallery1-8">
            <div class="container">
                <div class="mbr-section-head">
                    <h5 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 display-7">
                        Découvrez notre catalogue de produits. Identifiez les produits qui vous intéressent et
                        ajoutez les à votre panier.</h5>
                </div>
                <div class="row content-margin">
                    @foreach ($produits as $produit)
                    <x-produit-item :produit="$produit" :paProduits="$paProduits" :shop="$shop" />
                    @endforeach
                    @if ($produits->currentPage()!=$produits->lastPage())
                    <div class="col-12">
                        <a href="{{ $produits->nextPageUrl() }}" class="btn btn-secondary pull-right mr-2">Voir plus de
                            produits</a>
                    </div>
                    @endif
                </div>
            </div>
        </section>

        <section data-bs-version="5.1" class="social1 cid-sIpMTfwPPF" id="share1-a">
            <div class="container">
                <div class="media-container-row">
                    <div class="col-12">
                        <h3 class="mbr-section-title mb-3 align-center mbr-fonts-style display-5">
                            <strong>Partager cette page</strong></h3>
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