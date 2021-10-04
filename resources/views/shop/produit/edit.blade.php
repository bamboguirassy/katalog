@extends('base')

@section('title',$shop->nom." - Catalogue");

@section('description',"Mis à jour des informations du produit")

@section('body')
<section>
    <section data-bs-version="5.1" class="article1 cid-sIqERhONdL" id="content01-13">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <h1 class="mbr-section-title align-left mbr-fonts-style mb-3 display-7">Modification produit ?</h1>

                </div>
                <div class="col-lg-8">
                    <p class="mbr-text align-left mbr-fonts-style display-5">Ajoutez rapidement en produit à votre
                        catalogue
                        pour que les clients puissent le voir.<br></p>
                </div>
            </div>
        </div>
    </section>

    <section class="form cid-sIqFt45EGk" id="formbuilder-14">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto mbr-form">
                    <!--Formbuilder Form-->
                    <form action="{{ route('shop.produit.update',compact('shop','produit')) }}" method="POST"
                        class="mbr-form form-with-styler" data-form-title="produitNewForm">
                        @method('put')
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
                                <select value="{{ old('categorie_id') ?? $produit->categorie_id }}}"
                                    name="categorie_id" data-form-field="category" class="form-control display-7"
                                    id="category-formbuilder-14">
                                    @foreach ($categories as $categorie)
                                    <option @if($categorie->id==$produit->categorie_id) selected="selected" @endif
                                        value="{{$categorie->id}}">{{ $categorie->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="marque">
                                <label for="marque-formbuilder-14"
                                    class="form-control-label mbr-fonts-style display-7">Marque de produit</label>
                                <select value="{{ old('marque_id') ?? $produit->marque_id }}}"
                                    name="marque_id" data-form-field="marque" class="form-control display-7"
                                    id="marque-formbuilder-14">
                                    <option value="">Selectionner la marque (optionnel)</option>
                                    @foreach ($marques as $marque)
                                    <option @if($marque->id==$produit->marque_id) selected="selected" @endif
                                        value="{{$marque->id}}">{{ $marque->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div data-for="nom" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="nom-formbuilder-14" class="form-control-label mbr-fonts-style display-7">Nom
                                    produit</label>
                                <input value="{{ old('nom') ?? $produit->nom }}" type="text" name="nom"
                                    placeholder="Nom du produit" data-form-field="nom" class="form-control display-7"
                                    required="required" value="" id="nom-formbuilder-14">
                            </div>
                            <div ng-init="inPromo = {{$produit->inPromo}}" class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="inPromo">
                                <div class="form-control-label">
                                    <label for="inPromo-formbuilder-14" class="mbr-fonts-style display-7">En promotion
                                        ?</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input ng-click="inPromo = 0" type="radio" name="inPromo" data-form-field="inPromo" @if(!$produit->inPromo)
                                    checked="" @endif
                                    class="form-check-input display-7" value="0" id="inPromo-formbuilder-14">
                                    <label class="form-check-label display-7">Non</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input ng-click="inPromo = 1" type="radio" name="inPromo" data-form-field="inPromo"
                                        class="form-check-input display-7" value="1" @if($produit->inPromo) checked=""
                                    @endif
                                    id="inPromo-formbuilder-14">
                                    <label class="form-check-label display-7">Oui</label>
                                </div>
                            </div>
                            <div data-for="prixUnitaire" class="col form-group">
                                <label for="prixUnitaire-formbuilder-14"
                                    class="form-control-label mbr-fonts-style display-7">Prix Unitaire</label>
                                    @if ($produit->prixSurDemande)
                                    <div style="background-color: red; color: white; padding: 1px;" role="alert">
                                        <strong>Actuellement le prix est sur demande, donner une valeur supérieure à 0 ici va changer ce statut.</strong>
                                    </div>
                                    @endif
                                    <input value="{{ old('prixUnitaire') ?? $produit->prixUnitaire }}" type="number"
                                    name="prixUnitaire" placeholder="Prix Unitaire" data-form-field="prixUnitaire"
                                    class="form-control display-7" min="5" step="1" value=""
                                    id="prixUnitaire-formbuilder-14">
                            </div>
                            <div data-for="prixPromo" class="col form-group" ng-if="inPromo">
                                <label for="prixPromo-formbuilder-14"
                                    class="form-control-label mbr-fonts-style display-7">Prix Promo</label>
                                <input value="{{ old('prixPromo') ?? $produit->prixPromo }}" type="number"
                                    name="prixPromo" placeholder="Prix Unitaire" data-form-field="prixPromo"
                                    class="form-control display-7" min="5" step="1" required="required" value=""
                                    id="prixPromo-formbuilder-14">
                            </div>
                            <div data-for="quantite" class="col form-group">
                                <label for="quantite-formbuilder-14"
                                    class="form-control-label mbr-fonts-style display-7">Quantité disponible</label>
                                <input value="{{ old('quantite') ?? $produit->quantite }}" type="number" name="quantite"
                                    placeholder="Quantité en stock" data-form-field="quantite"
                                    class="form-control display-7" min="0" step="1" required="required" value=""
                                    id="quantite-formbuilder-14">
                            </div>
                            <div data-for="description" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="description-formbuilder-14"
                                    class="form-control-label mbr-fonts-style display-7">Description du produit</label>
                                <textarea name="description" placeholder="Description du produit"
                                    data-form-field="description" class="form-control display-7" required="required"
                                    id="description-formbuilder-14">{{ old('description') ?? $produit->description }}</textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="visible">
                                <div class="form-control-label">
                                    <label for="visible-formbuilder-14" class="mbr-fonts-style display-7">Visible dans
                                        la
                                        boutique ?</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="visible" data-form-field="visible" @if(!$produit->visible)
                                    checked="" @endif
                                    class="form-check-input display-7" value="Non" id="visible-formbuilder-14">
                                    <label class="form-check-label display-7">Non</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="visible" data-form-field="visible"
                                        class="form-check-input display-7" value="Oui" @if($produit->visible) checked=""
                                    @endif
                                    id="visible-formbuilder-14">
                                    <label class="form-check-label display-7">Oui</label>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-danger display-7"><span
                                        class="mobi-mbri mobi-mbri-plus mbr-iconfont mbr-iconfont-btn"></span>Mettre à
                                    jour</button>
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