@extends('base')

@section('title',"Détails produit - ".$produit->nom);

@section('description',$produit->description)

@section('body')
<style>
    .product {
        background-color: #eee
    }

    .brand {
        font-size: 13px
    }

    .act-price {
        color: #1c73ba;
        font-weight: 700
    }

    .dis-price {
        text-decoration: line-through;
    }

    .about {
        font-size: 14px
    }

    .color {
        margin-bottom: 10px
    }

    label.radio {
        cursor: pointer
    }

    label.radio input {
        position: absolute;
        top: 0;
        left: 0;
        visibility: hidden;
        pointer-events: none
    }

    label.radio span {
        padding: 2px 9px;
        border: 2px solid #1c73ba;
        display: inline-block;
        color: #1c73ba;
        border-radius: 3px;
        text-transform: uppercase
    }

    label.radio input:checked+span {
        border-color: #1c73ba;
        border-width: 5px;
        background-color: #1c73ba;
        color: #fff
    }

    .btn-danger {
        background-color: #ff0000 !important;
        border-color: #ff0000 !important
    }

    .btn-danger:hover {
        background-color: #da0606 !important;
        border-color: #da0606 !important
    }

    .btn-danger:focus {
        box-shadow: none
    }

    .cart i {
        margin-right: 10px
    }
</style>
<div class="container mt-5 mb-5" ng-init="produit = {{$produit}}">
    [[produit.variants]]
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images">
                            <div class="text-center p-4">
                                <img id="main-image"
                                    src="{{ asset('storage/produits/images/'.$produit->imageCouverture->nom) }}"
                                    style="height: 400px; object-fit: fill;" />
                            </div>
                            <div class="thumbnail">
                                @foreach ($produit->images as $image)
                                <img onclick="change_image(this)"
                                    src="{{ asset('storage/produits/images/'.$image->nom) }}"
                                    style="width: 70px; display: inline;">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="d-flex justify-content-between align-items-center">

                                <i class="fa fa-shopping-cart text-muted"></i>
                            </div>
                            <div class="mt-4 mb-3"> <span
                                    class="text-uppercase text-muted brand">{{ $produit->categorie->nom }}</span>
                                <h5 class="text-uppercase">{{ $produit->nom }}</h5>
                                <div class="price d-flex flex-row align-items-center"> <span
                                        class="act-price">{{ $produit->prixUnitaire }} FCFA</span>
                                    <div class="ml-2"> <small class="dis-price">$59</small> <span>40% OFF</span> </div>
                                </div>
                            </div>
                            <p class="about">{{ $produit->description }}</p>
                            @foreach ($produit->attributs as $attributProduit)
                            <div class="sizes mt-2">
                                <h6 class="text-uppercase">{{$attributProduit->attribut->nom}}</h6>
                                @foreach ($attributProduit->valeurs as $attrProdVal)
                                <label class="radio">
                                    <input type="radio" name="{{$attributProduit->attribut->nom}}"
                                        value="{{$attrProdVal->id}}">
                                    @if ($attributProduit->attribut->type=='couleur')
                                    <span title="{{ $attrProdVal->valeurAttribut->nom }}"
                                        style="height: 20px; width: 30px; background-color: {{$attrProdVal->valeurAttribut->valeur}}"></span>
                                    @else
                                    <span title="{{ $attrProdVal->valeurAttribut->nom }}">{{ $attrProdVal->valeurAttribut->valeur }}</span>
                                    @endif
                                </label>
                                @endforeach
                            </div>
                            @endforeach
                            <div class="cart mt-4 align-items-center">
                                @if (in_array($produit->id, $paProduits))
                                <a style="background: green; color: white;" class="btn item-btn display-4">
                                    Dans le panier <i class="fa fa-check"></i>
                                </a>
                                @else
                                <button ng-click="initProductToPanier({{$produit}})" class="btn btn-primary text-uppercase mr-2 px-4">Ajouter au panier</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

<script>
    function change_image(image){
        var container = document.getElementById("main-image");
        container.src = image.src;
    }
    document.addEventListener("DOMContentLoaded", function(event) {});
</script>
@endsection