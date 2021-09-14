@extends('base')

@section('title',"Détails produit - ".$produit->nom);

@section('description',$produit->description)

@section('body')
<section data-bs-version="5.1" class="article5 cid-sIrEzxbcOc" id="article06-1c">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-12 col-lg">
                <div class="card-wrapper align-left">
                    <h6 class="card-title mbr-fonts-style mb-4 display-2"><strong>{{ $produit->nom }}</strong></h6>
                    <p class="mbr-text mbr-fonts-style display-7"><strong>{{ $produit->description }}</strong><br></p>
                    <div class="mbr-section-btn">
                        <a class="btn btn-lg btn-secondary display-4" >
                            AJOUTER AU PANIER
                        </a>

                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="image-wrapper">
                    <span class="price-badge">{{ $produit->prixUnitaire }} FCFA</span>
                    <span class="category-badge">{{ $produit->categorie->nom }}</span>
                    <img style="height: 400px; object-fit: content;"
                        src="{{ asset('storage/produits/images/'.$produit->imageCouverture->nom) }}"
                        alt="Image de couverture">
                </div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="gallery6 mbr-gallery cid-sIsb7KGEzR" id="gallery6-1n">
    <div class="container-fluid">
        <div class="mbr-section-head">
            <h3 class="mbr-section-title mbr-fonts-style align-center m-0 display-2"><strong>Galerie photo du
                    produit</strong></h3>

        </div>
        <div class="row mbr-gallery mt-4">
            @foreach ($produit->images as $image)
            <div class="col-12 col-md-6 col-lg-3 item gallery-image">
                <div class="item-wrapper" data-toggle="modal" data-bs-toggle="modal" data-target="#sIw8XBZBnS-modal"
                    data-bs-target="#sIw8XBZBnS-modal">
                    <img class="w-100" src="{{ asset('storage/produits/images/'.$image->nom) }}" alt=""
                        data-slide-to="0" data-bs-slide-to="0" data-target="#lb-sIw8XBZBnS"
                        data-bs-target="#lb-sIw8XBZBnS">
                    <div class="icon-wrapper">
                        <span class="mobi-mbri mobi-mbri-search mbr-iconfont mbr-iconfont-btn"></span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="modal mbr-slider" tabindex="-1" role="dialog" aria-hidden="true" id="sIw8XBZBnS-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="carousel slide" id="lb-sIw8XBZBnS" data-interval="5000" data-bs-interval="5000">
                            <div class="carousel-inner">
                                @for ($i=0;$i<count($produit->images);$i++)
                                    <div class="carousel-item @if ($i==0) active @endif">
                                        <img class="d-block w-100"
                                            src="{{ asset('storage/produits/images/'.$produit->images[$i]->nom) }}"
                                            alt="">
                                    </div>
                                    <? $i++; ?>
                                    @endfor
                            </div>
                            <ol class="carousel-indicators">
                                <li data-slide-to="0" data-bs-slide-to="0" class="active" data-target="#lb-sIw8XBZBnS"
                                    data-bs-target="#lb-sIw8XBZBnS"></li>
                                <li data-slide-to="1" data-bs-slide-to="1" data-target="#lb-sIw8XBZBnS"
                                    data-bs-target="#lb-sIw8XBZBnS"></li>
                                <li data-slide-to="2" data-bs-slide-to="2" data-target="#lb-sIw8XBZBnS"
                                    data-bs-target="#lb-sIw8XBZBnS"></li>
                                <li data-slide-to="3" data-bs-slide-to="3" data-target="#lb-sIw8XBZBnS"
                                    data-bs-target="#lb-sIw8XBZBnS"></li>
                            </ol>
                            <a role="button" href="" class="close" data-dismiss="modal" data-bs-dismiss="modal"
                                aria-label="Close">
                            </a>
                            <a class="carousel-control-prev carousel-control" role="button" data-slide="prev"
                                data-bs-slide="prev" href="#lb-sIw8XBZBnS">
                                <span class="mobi-mbri mobi-mbri-arrow-prev" aria-hidden="true"></span>
                                <span class="sr-only visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next carousel-control" role="button" data-slide="next"
                                data-bs-slide="next" href="#lb-sIw8XBZBnS">
                                <span class="mobi-mbri mobi-mbri-arrow-next" aria-hidden="true"></span>
                                <span class="sr-only visually-hidden">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="social1 cid-sIrHQR2e1u" id="share1-1d">
    <div class="container">
        <div class="media-container-row">
            <div class="col-12">
                <h3 class="mbr-section-title mb-3 align-center mbr-fonts-style display-5">
                    <strong>Partager ce produit</strong></h3>
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
@endsection