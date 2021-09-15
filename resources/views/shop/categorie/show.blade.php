@extends('base')

@section('title',$shop->nom.' '.$categorie->nom.' Liste produits');

@section('description',$shop->description)

@section('body')
<div class="row">
    <div class="col-12">
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
                    <div class="col-md-12 col-lg-8 py-4 m-auto">
                        <h1 class="mbr-section-title mbr-regular pb-3 align-left mbr-fonts-style display-1">
                            {{$shop->nom}} -> {{$categorie->nom}}
                        </h1>

                        <p class="mbr-text mbr-light pb-3 align-left mbr-fonts-style display-7">
                            {{$categorie->description}}
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-12 align-center">
                        <div class="img-box">
                            <a href="{{ route('shop.home',compact('shop')) }}">
                                <img style="max-height: 300px; object-fit: cover;" src="{{ asset('storage/shops/'.$shop->logo) }}" alt="">
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
                            <div class="card-box align-center" style="height: 20px;">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section data-bs-version="5.1" class="gallery1 cid-sIpMwjCas3" id="gallery1-8">
            <div class="container">
                <div class="mbr-section-head">

                    <h5 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 display-7">
                        Découvrez notre catalogue de produits. Identifiez les produits qui vous intéressent et
                        appelez-nous pour finaliser la commande.</h5>
                </div>
                <div class="row content-margin">
                    @foreach ($produits as $produit)
                    <div class="item features-image сol-12 col-md-6 col-lg-4">
                        <div class="item-wrapper">
                            <div class="item-img">
                                <span class="category-badge">{{ $produit->categorie->nom }}</span>
                                <span class="price-badge">{{ $produit->prixUnitaire }} FCFA</span>
                                <a href="{{ route('shop.produit.display',compact('produit','shop')) }}">
                                    <img src="{{ asset('storage/produits/images/'.$produit->imageCouverture->nom) }}"
                                        alt="">
                                </a>
                            </div>
                            <div class="item-content">
                                <a href="{{ route('shop.produit.display',compact('produit','shop')) }}">
                                    <h5 title="{{ $produit->nom }}" class="item-title mbr-fonts-style display-5">
                                        {{ \Illuminate\Support\Str::limit($produit->nom, 20, '...') }}
                                    </h5>
                                    <p style="min-height: 100px" class="mbr-text mbr-fonts-style display-7">
                                        {{ \Illuminate\Support\Str::limit($produit->description, 100, '...') }}
                                    </p>
                                </a>
                            </div>
                            <div class="mbr-section-btn item-footer">
                                @if (in_array($produit->id, $paProduits))
                                    <a style="background: green; color: white;"
                                        class="btn item-btn display-4">
                                        Dans le panier <i class="fa fa-check"></i>
                                    </a>
                                @else
                                    <a ng-click="initProductToPanier({{$produit}})"
                                        class="btn btn-primary item-btn display-4">
                                        AJOUTER AU PANIER
                                    </a>
                                @endif
                                </a>
                            </div>
                        </div>
                    </div>
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