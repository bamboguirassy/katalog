@extends('base')

@section('title',$shop->nom." - Catalogue");

@section('description',"")

@section('body')
<section ng-controller="ProduitNewController">
    <section data-bs-version="5.1" class="article1 cid-sIqERhONdL" id="content01-13">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <h1 class="mbr-section-title align-left mbr-fonts-style mb-3 display-7">Nouveau produit ?</h1>

                </div>
                <div class="col-lg-8">
                    <p class="mbr-text align-left mbr-fonts-style display-5">Ajoutez rapidement des produits à votre
                        catalogue
                        pour que les clients puissent le voir.<br></p>
                </div>
                <div class="col-lg-4">

                </div>
            </div>
        </div>
    </section>

    <section class="form cid-sIqFt45EGk" id="formbuilder-14" ng-init="attributs = {{$attributs}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto mbr-form">
                    <!--Formbuilder Form-->
                    <form action="{{ route('shop.produit.store',compact('shop')) }}" method="POST"
                        class="mbr-form form-with-styler" data-form-title="produitNewForm"
                        enctype="multipart/form-data">
                        @method('post')
                        @csrf
                        <div class="form-row">
                            @foreach ($errors->all() as $message)
                            <div data-form-alert-danger="" class="alert alert-danger col-12">
                                {{$message}}</div>
                            @endforeach
                        </div>
                        <div class="dragArea form-row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h4 class="mbr-fonts-style display-5">Ajout d'un nouveau produit</h4>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="category">
                                <label for="category-formbuilder-14"
                                    class="form-control-label mbr-fonts-style display-7">Catégorie de produit</label>
                                <select value="{{ old('categorie_id') }}}" name="categorie_id"
                                    data-form-field="category" class="form-control display-7"
                                    id="category-formbuilder-14">
                                    <option selected value="" disabled>Selectionner une catégorie</option>
                                    @foreach ($categories as $categorie)
                                    @if(count($categorie->subs)<1)
                                    <option value="{{$categorie->id}}">{{ $categorie->nom }}</option>
                                    @else
                                    @while (count($categorie->subs))
                                    <optgroup label="{{$categorie->nom}}">
                                        @foreach ($categorie->subs as $sub)
                                        <option value="{{$sub->id}}">{{ $sub->nom }}</option>
                                        @endforeach
                                    </optgroup>
                                    <?php $categorie = $sub ?>
                                    @endwhile
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="marque">
                                <label for="marque-formbuilder-14"
                                    class="form-control-label mbr-fonts-style display-7">Marque de produit</label>
                                <select
                                    name="marque_id" data-form-field="marque" class="form-control display-7"
                                    id="marque-formbuilder-14">
                                    <option selected value="" disabled>Selectionner la marque (optionnel)</option>
                                    @foreach ($marques as $marque)
                                    <option @if(old('marque_id')==$marque->id) selected="selected" @endif
                                        value="{{$marque->id}}">{{ $marque->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div data-for="nom" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="nom-formbuilder-14" class="form-control-label mbr-fonts-style display-7">Nom
                                    produit</label>
                                <input value="{{ old('nom') }}" type="text" name="nom" placeholder="Nom du produit"
                                    data-form-field="nom" class="form-control display-7" required="required" value=""
                                    id="nom-formbuilder-14">
                            </div>
                            <div data-for="prixUnitaire" class="col form-group">
                                <label for="prixUnitaire-formbuilder-14"
                                    class="form-control-label mbr-fonts-style display-7">Prix Unitaire</label>
                                <input value="{{ old('prixUnitaire') }}" type="number" name="prixUnitaire"
                                    placeholder="Prix Unitaire" data-form-field="prixUnitaire"
                                    class="form-control display-7" min="5" step="1" required="required" value=""
                                    id="prixUnitaire-formbuilder-14">
                            </div>
                            <div data-for="quantite" class="col form-group">
                                <label for="quantite-formbuilder-14"
                                    class="form-control-label mbr-fonts-style display-7">Quantité disponible</label>
                                <input value="{{ old('quantite') }}" type="number" name="quantite"
                                    placeholder="Quantité en stock" data-form-field="quantite"
                                    class="form-control display-7" min="0" step="1" required="required" value=""
                                    id="quantite-formbuilder-14">
                            </div>
                            <div data-for="description" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="description-formbuilder-14"
                                    class="form-control-label mbr-fonts-style display-7">Description du produit</label>
                                <textarea name="description" placeholder="Description du produit"
                                    data-form-field="description" class="form-control display-7" required="required"
                                    id="description-formbuilder-14">{{ old('description') }}</textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p class="mbr-fonts-style display-7">Galerie du produit</p>
                            </div>
                            <div data-for="photos" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="photos-formbuilder-14"
                                    class="form-control-label mbr-fonts-style display-7">Sélectionner des photos</label>
                                <input value="{{old('photos')}}" type="file" multiple="multiple" accept="image/*"
                                    name="photos[]" placeholder="Sélectionner des photos du produit"
                                    data-form-field="photos" required="required" class="form-control display-7" value=""
                                    id="photos-formbuilder-14">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="moreAttributes">
                                <div class="form-control-label">
                                    <label for="visible-formbuilder-14" class="mbr-fonts-style display-7">Voulez-vous
                                        ajouter d'autres attributs ?</label>
                                    <span>Si vous ne retrouvez pas certains attributs, merci de les créer en suivant ce
                                        lien: <a href="{{ route('shop.attribut.index', compact('shop')) }}">Ajouter de
                                            nouveaux attributs</a></span>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input ng-model="hasMoreAttr" checked type="radio" name="hasMoreAttributes"
                                        data-form-field="moreAttributes" class="form-check-input display-7" value="0"
                                        id="visible-formbuilder-14no">
                                    <label class="form-check-label display-7">Non</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input ng-model="hasMoreAttr" type="radio" name="hasMoreAttributes"
                                        data-form-field="moreAttributes" class="form-check-input display-7"
                                        id="visible-formbuilder-14yes" value="1">
                                    <label class="form-check-label display-7">Oui</label>
                                </div>
                            </div>
                            <div ng-if="hasMoreAttr==1" class="col-lg-12 col-md-12 col-sm-12 form-group"
                                data-for="selectedAttr">
                                <div class="form-control-label">
                                    <label for="visible-formbuilder-14[[$index]]"
                                        class="mbr-fonts-style display-7">Selectionner les attributs</label>
                                </div>
                                <div ng-repeat="attr in attributs" class="form-check form-check-inline">
                                    <input ng-click="toggleAttrSelection(attr)" type="checkbox" name="selectedAttrs[]"
                                        data-form-field="selectedAttr" class="form-check-input display-7"
                                        value="[[attr.id]]" id="visible-formbuilder-14[[$index]]">
                                    <label class="form-check-label display-7">[[attr.nom]]</label>
                                </div>
                            </div>
                            <div ng-repeat="selectedAttr in selectedAttrs"
                                class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="category">
                                <label for="category-formbuilder-14[[selectedAttr.id]]"
                                    class="form-control-label mbr-fonts-style display-7">[[selectedAttr.nom]]</label>
                                <select required="required" name="[[selectedAttr.nom]][]" multiple="multiple"
                                    data-form-field="category" class="form-control display-7"
                                    id="category-formbuilder-14[[selectedAttr.id]]">
                                    <option ng-repeat="valeur in selectedAttr.valeurs" value="[[valeur.id]]">
                                        [[valeur.nom]]</option>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary display-7"><span
                                        class="mobi-mbri mobi-mbri-plus mbr-iconfont mbr-iconfont-btn"></span>Ajouter</button>
                            </div>
                        </div>
                    </form>
                    <!--Formbuilder Form-->
                </div>
            </div>
        </div>
    </section>
</section>
@endsection