@extends('base')

@section('title',"Détails produit - ".$produit->nom);

@section('description',$produit->description)

@section('body')
<style>
    .hedding {
        font-size: 20px;
        color: #ab8181`;
    }

    .left-side-product-box img {
        width: 100%;
    }

    .left-side-product-box .sub-img img {
        margin-top: 5px;
        width: 83px;
        height: 100px;
    }

    .right-side-pro-detail span {
        font-size: 15px;
    }

    .right-side-pro-detail p {
        font-size: 25px;
        color: #a1a1a1;
    }

    .right-side-pro-detail .price-pro {
        color: #E45641;
    }

    .right-side-pro-detail .tag-section {
        font-size: 18px;
        color: #5D4C46;
    }

    .pro-box-section .pro-box img {
        width: 100%;
        height: 200px;
    }

    @media (min-width:360px) and (max-width:640px) {
        .pro-box-section .pro-box img {
            height: auto;
        }
    }
</style>
<section ng-cloak ng-controller="ProduitShowController" ng-init="init({{$produit}},{{$attributs}})">
    <div class="container mt-3">
        <div class="col-lg-12 border p-3 main-section bg-white">
            <div class="row m-0">
                <div class="col-lg-4 left-side-product-box pb-3">
                    <img src="{{ asset('uploads/produits/images/'.$produit->imageCouverture->nom) }}"
                        class="border p-3">
                </div>
                <div class="col-lg-8">
                    <div class="right-side-pro-detail border p-3 m-0" ng-init="addAttribut=false">
                        <div class="row">
                            <div class="col-lg-12">
                                @foreach ($produit->categorieProduits as $categorieProd)
                                <span style="font-size: 22px;"><a
                                        href="{{ route('shop.categorie.show',['categorie'=>$categorieProd,'shop'=>$shop]) }}">{{$categorieProd->categorie->nom}}</a>
                                    >></span>
                                @endforeach
                                <p class="m-0 p-0 mt-3">@{{ produit.nom }}</p>
                            </div>
                            <div class="col-lg-12">
                                @if ($produit->prixSurDemande)
                                <div style="background-color: red; color: white; padding: 3px;" role="alert">
                                    <strong>Prix sur demande</strong>
                                </div>
                                @else
                                    <p class="m-0 p-0 price-pro">@{{produit.prixUnitaire}} FCFA</p>
                                @endif
                                <hr class="p-0 m-0">
                            </div>
                            <div class="col-lg-12 pt-2 pb-2">
                                <h5>Détails Produit</h5>
                                <span>@{{ produit.description }}</span>
                                <hr class="m-0 pt-2 mt-2">
                            </div>
                            <div class="col-lg-12" ng-init="attribut.add=false"
                                ng-repeat="attribut in produit.attributs" style="margin-top: 3px;">
                                <p class="tag-section"
                                    ng-init="attribut.original = (attributs|where:{id:attribut.attribut.id}|first)">
                                    <button ng-show="produit.variants.length<1" ng-click="removeAttribute(attribut)"
                                        class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                    <strong>@{{attribut.attribut.nom}} : </strong>
                                    <span ng-repeat="valeur in attribut.valeurs"
                                        title="@{{ valeur.valeur_attribut.nom }}"
                                        style="border: 2px solid #1c73ba; padding: 3px; margin-left: 3px;">
                                        @{{valeur.valeur_attribut.attribut.type=='texte'?valeur.valeur_attribut.valeur:valeur.valeur_attribut.nom}}
                                        <b ng-show="produit.variants.length<1" ng-click="removeValue(valeur)"
                                            style="font-size: 20px; color: red;">x</b>
                                    </span>
                                    <button ng-if="!attribut.add && produit.variants.length<1"
                                        ng-click="attribut.add = !attribut.add" class="btn btn-primary btn-sm">
                                        <i class="fa fa-plus" aria-hidden="true"></i></button>
                                    <div class="row">
                                        <div class="col-12 col-lg-8">
                                            <select ng-model="attribut.newValues" multiple="multiple"
                                                class="form-control" ng-if="attribut.add" name="attribut@{{attribut.id}}"
                                                id="attribut@{{attribut.id}}">
                                                <option
                                                    ng-hide="(attribut.valeurs|map:'valeur_attribut.id')|contains:originalVal.id"
                                                    ng-repeat="originalVal in attribut.original.valeurs"
                                                    value="@{{originalVal.id}}">@{{
                                                    originalVal.nom }}</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <button ng-click="addNewValuesToAttribute(attribut)" ng-if="attribut.add"
                                                class="btn btn-secondary btn-sm">
                                                <i class="fa fa-save" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </p>
                            </div>
                            @if (count($produit->couleurProduits))
                            <div class="col-lg-12">
                                <h4>Gérer les photos de produit par couleur</h4>
                                <div class="row">
                                    @foreach ($produit->couleurProduits as $couleurProduit)
                                    <div class="col-12 mb-3" style="border-left: 2px solid darkgray;">
                                        <strong>
                                            <i>{{$loop->index+1}}.</i>
                                            Couleur {{$couleurProduit->couleur->nom}}
                                            <span
                                                style="border: 2px solid gray; background-color: {{$couleurProduit->couleur->color}}">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                        </strong>
                                        <form style="display: inline;"
                                            action="{{ route('shop.couleurproduit.destroy',['couleurproduit'=>$couleurProduit,'shop'=>$shop]) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button
                                                title="Vous pouvez supprimer cette couleur et les photos..."
                                                class="fa fa-2x fa-trash-o pull-right text-danger"
                                                aria-hidden="true"></button>
                                        </form>
                                        <table class="table">
                                            <tr>
                                                <td colspan="4">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label
                                                                    class="form-control-label mbr-fonts-style display-7">Ajouter
                                                                    des
                                                                    photos</label>
                                                                <form name="addCouleurProduitImageForm"
                                                                    action="{{ route('shop.couleurproduit.add.images',compact('couleurProduit','shop')) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @method('post')
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-12 col-lg-6">
                                                                            <input required="required" type="file"
                                                                                multiple="multiple" accept="image/*"
                                                                                name="photos[]" required="required"
                                                                                class="form-control display-7"
                                                                                id="produitCouleurProduitImageInput{{$loop->index}}">
                                                                        </div>
                                                                        <div class="col-12 col-lg-6">
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Téléverser</button>
                                                                        </div>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        @foreach ($couleurProduit->images as $image)
                                                        <div class="col-12 col-md-6 col-lg-3">
                                                            <img style="height: 210px;"
                                                                src="{{ asset('uploads/produits/images/'.$image->nom) }}"
                                                                alt="">
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            <div class="col-12" ng-show="!addAttribut && produit.variants.length<1">
                                <button ng-click="addAttribut = !addAttribut" type="button"
                                    class="btn btn-primary">Ajouter d'autres attributs</button>
                            </div>
                            <form method="post"
                                action="{{ route('shop.attributproduit.save.multiple',compact('shop','produit')) }}">
                                @csrf
                                @method('post')
                                <div ng-if="addAttribut" class="col-lg-12 col-md-12 col-sm-12 form-group"
                                    data-for="selectedAttr">
                                    <div class="form-control-label">
                                        <label for="visible-formbuilder-14@{{$index}}"
                                            class="mbr-fonts-style display-7">Selectionner les attributs</label>
                                    </div>
                                    <ng-container ng-repeat="attr in attributs">
                                        <div ng-if="!((produit.attributs|map:'attribut.id')|contains:attr.id)"
                                            class="form-check form-check-inline">
                                            <input ng-click="toggleAttrSelection(attr)" type="checkbox"
                                                name="selectedAttrs[]" data-form-field="selectedAttr"
                                                class="form-check-input display-7" value="@{{attr.id}}"
                                                id="visible-formbuilder-14@{{$index}}">
                                            <label class="form-check-label display-7">@{{attr.nom}}</label>
                                        </div>
                                    </ng-container>
                                </div>
                                <div ng-repeat="selectedAttr in selectedAttrs"
                                    class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="category">
                                    <label for="category-formbuilder-14@{{selectedAttr.id}}"
                                        class="form-control-label mbr-fonts-style display-7">@{{selectedAttr.nom}}</label>
                                    <select required="required" name="@{{selectedAttr.nom}}[]" multiple="multiple"
                                        data-form-field="category" class="form-control display-7"
                                        id="category-formbuilder-14@{{selectedAttr.id}}">
                                        <option ng-repeat="valeur in selectedAttr.valeurs" value="@{{valeur.id}}">
                                            @{{valeur.nom}}</option>
                                    </select>
                                </div>
                                <div class="col-12" ng-show="addAttribut && selectedAttrs.length>0">
                                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                </div>
                            </form>
                            <hr class="m-0 pt-2 mt-2">
                            <div class="col-lg-12 mt-3">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a href="{{ route('shop.produit.edit',compact('produit','shop')) }}"
                                            class="btn btn-warning w-100 m-0">Modifier</a>
                                    </div>
                                    <div class="col-lg-6">
                                        <form style="display: inline;"
                                            action="{{ route('shop.produit.destroy',compact('shop','produit')) }}"
                                            method="POST">
                                            @method('delete')
                                            @csrf
                                            <button style="display: inline;"
                                                class="btn btn-danger m-0 p-0 w-100 mbr-white">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" ng-show="produit.variants.length<1 && produit.attributs.length>0">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Générer les combinaisons</h4>
                            <p class="card-text">
                                Cliquez sur le bouton ci-dessous pour générer et paramétrer l'ensemble des combinaisons
                                selons les attributs du produit. <br>
                                Une fois les combinaisons générées, vous ne pourrez plus ajouter de nouveaux
                                attributs...
                            </p>
                        </div>
                        <div class="card-body">
                            <button ng-click="generateCombination()" class="card-link btn btn-primary">Générer les
                                combinaisons</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" ng-show="produit.variants.length>0">
                    <h4>Gérer les combinaisons de produit</h4>
                    <div class="row">
                        <div class="col-12 mb-3" ng-repeat="variant in produit.variants"
                            style="border-left: 2px solid darkgray;">
                            <strong style="color: #1c73ba;">
                                <i>@{{$index+1}}.</i> @{{produit.nom}} -
                                @{{(variant.attribut_values|map:'valeur_attribut_produit.valeur_attribut.nom')|join:' x
                                '}}
                            </strong>
                            <button ng-click="removeVariant(variant)"
                                title="Vous pouvez supprimer les variants qui n'ont pas d'importance pour le produit..."
                                class="fa fa-2x fa-trash-o pull-right text-danger" aria-hidden="true"></button>
                            <button style="color: orange;" ng-show="variant.configured" ng-click="variant.configured = false"
                                class="fa fa-2x fa-pencil pull-right text-default" aria-hidden="true"></button>
                            <hr style="margin-top: 0px;">
                            <form ng-submit="updateVariant(variant)" ng-show="!variant.configured">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="prixUnitaire@{{$index}}">Prix Unitaire</label>
                                            <input ng-model="variant.prixUnitaire" required="required" type="number"
                                                name="prixUnitaire@{{$index}}" id="prixUnitaire@{{$index}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="quantite@{{$index}}">Quantité</label>
                                            <input ng-model="variant.quantite" required="required" type="number"
                                                name="quantite@{{$index}}" id="quantite@{{$index}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-sm btn-primary pull-right"
                                            style="margin-left: 3px;">Enregistrer</button>
                                        <button ng-click="variant.configured=true" type="submit"
                                            class="btn btn-sm btn-secondary pull-right">Annuler</button>
                                    </div>
                                </div>
                            </form>
                            <table class="table">
                                <tr ng-show="variant.configured">
                                    <th>Prix unitaire</th>
                                    <td>@{{variant.prixUnitaire}} FCFA</td>
                                    <th>Quantité</th>
                                    <td>@{{variant.quantite}} élement(s)</td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <section data-bs-version="5.1" class="gallery2 cid-sIDTM1YNga" id="gallery2-1t">
        <div class="container">
            <div class="mbr-section-head">
                <h5 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 display-2">
                    Gérer la galerie d'image...</h5>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <h3>Ajouter d'autres images du produit</h3>
                </div>
                <hr>
                <div class="col-12">
                    <form action="{{ route('shop.produit.add.images', compact('shop','produit')) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div data-for="photos" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="photos-formbuilder-14"
                                class="form-control-label mbr-fonts-style display-7">Sélectionner des photos</label>
                            <input value="{{old('photos')}}" type="file" multiple="multiple" accept="image/*"
                                name="photos[]" placeholder="Sélectionner des photos du produit"
                                data-form-field="photos" required="required" class="form-control display-7" value=""
                                id="photos-formbuilder-14">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        </div>
                        <button name="" id="" class="btn btn-primary" role="button">Téléverser</button>
                    </form>
                </div>
                <hr>
                @foreach ($produit->images as $image)
                <div class="item features-image сol-12 col-md-4 col-lg-3">
                    <div class="item-wrapper">
                        <div class="item-img">
                            <img src="{{ asset('uploads/produits/images/'.$image->nom) }}">
                        </div>
                        <div class="mbr-section-btn item-footer mt-2">
                            @if ($image->id!=$produit->imageCouverture->id)
                            <form style="display: inline; float: right;"
                                action="{{ route('shop.image.destroy',compact('image','shop')) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button style="background: red; display: inline; margin-left: 3px;"
                                    class="btn item-btn mbr-white">
                                    <span class="mobi-mbri mobi-mbri-trash mbr-iconfont mbr-iconfont-btn"></span>
                                </button>
                            </form>
                            <form style="display: inline; float: right;"
                                action="{{ route('shop.produit.update.couverture.photo', compact('shop','image')) }}"
                                method="post">
                                @method('post')
                                @csrf
                                <button class="btn item-btn btn-info">Mettre en couverture</button>
                            </form>
                            @else
                            <span class="btn item-btn btn-info" style="color: green;">Actuellement en couverture</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</section>
{{-- <section data-bs-version="5.1" class="article5 cid-sIrEzxbcOc" id="article06-1c">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-wrapper align-left">
                        <h6 class="card-title mbr-fonts-style mb-4 display-2"><strong>{{ $produit->nom }}</strong></h6>
<p class="mbr-text mbr-fonts-style display-7"><strong>{{ $produit->description }}</strong><br>
</p>
<div class="mbr-section-btn">
    <form style="display: inline; float: right;" action="{{ route('shop.produit.destroy',compact('shop','produit')) }}"
        method="POST">
        @method('delete')
        @csrf
        <button style="background: red; display: inline;" class="btn mbr-white">
            <span class="mobi-mbri mobi-mbri-trash mbr-iconfont mbr-iconfont-btn"
                style="color: rgb(255, 255, 255);"></span>
            Supprimer
        </button>
    </form>
    <a style="background: orange;" class="btn mbr-white"
        href="{{ route('shop.produit.edit',compact('produit','shop')) }}"><span
            class="mobi-mbri mobi-mbri-edit mbr-iconfont mbr-iconfont-btn"></span>Modifier</a>
</div>
</div>
</div>
</div>
<div class="col-12 col-lg-4">
    <div class="image-wrapper">
        <span class="price-badge">{{ $produit->prixUnitaire }} FCFA</span>
        <span class="category-badge">{{ $produit->categorie->nom }}</span>
        <img style="height: 400px;" src="{{ asset('uploads/produits/images/'.$produit->imageCouverture->nom) }}"
            alt="Image de couverture">
    </div>
</div>
</div>
</div>
</section>
--}}
@endsection