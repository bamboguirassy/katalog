@extends('base')

@section('title',"Nouvelle Boutique");

@section('description',"Créer votre boutique dès aujourd'hui sur ".config('app.name'))

@section('body')
<section data-bs-version="5.1" class="header3 agencym4_header3 cid-sIqqheaqtl" id="header3-p">
    <div class="container align-center">
        <div class="row justify-content-center">
            <div class="media-container-column mbr-white col-md-10">
                <h3 class="mbr-section-subtitle align-center mbr-light pb-1 mbr-fonts-style display-2">
                    Mettre à jour la boutique</h3>
            </div>
        </div>
    </div>

</section>

<section ng-init="init({{$shop}})" class="form cid-sIqqPj8uvi" id="formbuilder-q" ng-controller="ShopNewController">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto mbr-form">
                <!--Formbuilder Form-->
                <form action="{{route('shop.update',compact('shop'))}}" method="POST" class="mbr-form form-with-styler"
                    data-form-title="boutiqueNewForm" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-row">
                        <div hidden="hidden" data-form-alert="" class="alert alert-success col-12"></div>
                        @foreach ($errors->all() as $message)
                        <div data-form-alert-danger="" class="alert alert-danger col-12">{{$message}}</div>
                        @endforeach
                    </div>
                    <div class="dragArea form-row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4 class="mbr-fonts-style display-5">Formulaire de mise à jour de boutique</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div data-for="nom" class="col-lg-12 col-md-12 col-sm-12 form-group" style="">
                            <label for="nom-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Nom</label>
                            <input ng-model="shop.nom" ng-change="handleShopNameChangeUpdate()" 
                                type="text" name="nom" placeholder="Nom de la boutique" data-form-field="nom"
                                class="form-control display-7" required="required" id="nom-formbuilder-q">
                        </div>
                        <div data-for="pseudonyme" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="pseudonyme-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Pseudonyme (Ceci est l'identifiant
                                de la boutique)</label>
                            <input hidden="hidden" style="color: blue;" ng-model="shop.pseudonyme" type="text"
                                name="pseudonyme" placeholder="Pseudonyme de votre boutique"
                                data-form-field="pseudonyme" class="form-control display-7" required="required"
                                id="pseudonyme-formbuilder-q">
                            <span style="margin-top: 3px;" ng-if="shop.pseudonyme!=''">Le lien de votre boutique sera : <b
                                    style="color: blue;">{{request()->getHttpHost()}}/@{{shop.pseudonyme}}</b></span>
                        </div>
                        <div data-for="categorie" class="col-lg-12 col-md-12 col-sm-12 form-group" style="">
                            <label for="categorie-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Quelle catégorie de produit vous
                                vendez ?</label>
                            <select value="{{old('categorie_id') ?? $shop->categorie_id}}" name="categorie_id" data-form-field="categorie"
                                class="form-control display-7" id="categorie-formbuilder-q">
                                @foreach ($types as $type)
                                <option value="{{$type->id}}">{{$type->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" style="">
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p class="mbr-fonts-style display-7">Information de contact</p>
                        </div>
                        <div data-for="telephonePrimaire" class="col form-group">
                            <label for="telephonePrimaire-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Téléphone Primaire</label>
                            <input value="{{old('telephonePrimaire') ?? $shop->telephonePrimaire}}" type="tel" name="telephonePrimaire"
                                placeholder="Numéro de téléphone primaire" data-form-field="telephonePrimaire"
                                class="form-control display-7" pattern="*" required="required" value=""
                                id="telephonePrimaire-formbuilder-q">
                        </div>
                        <div data-for="telephoneSecondaire" class="col form-group">
                            <label for="telephoneSecondaire-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Téléphone Secondaire</label>
                            <input value="{{old('telephoneSecondaire') ?? $shop->telephoneSecondaire}}" type="tel" name="telephoneSecondaire"
                                placeholder="Numéro de téléphone sécondaire" data-form-field="telephoneSecondaire"
                                class="form-control display-7" value="" id="telephoneSecondaire-formbuilder-q">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="description">
                            <label for="description-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Description</label>
                            <textarea name="description" placeholder="Parlez nous un peu de votre boutique."
                                data-form-field="description" required="required" class="form-control display-7"
                                id="description-formbuilder-q">{{old('description') ?? $shop->description}}</textarea>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p class="mbr-fonts-style display-7">Lien réseaux sociaux</p>
                        </div>
                        <div data-for="facebook" class="col form-group">
                            <label for="facebook-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Facebook</label>
                            <input value="{{old('facebook') ?? $shop->facebook}}" type="url" name="facebook" placeholder="https://"
                                pattern="https://.*" data-form-field="facebook" class="form-control display-7" value=""
                                id="facebook-formbuilder-q">
                        </div>
                        <div data-for="instagram" class="col form-group">
                            <label for="instagram-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Instagram</label>
                            <input value="{{old('instagram') ?? $shop->instagram}}" type="url" name="instagram" placeholder="https://"
                                pattern="https://.*" data-form-field="instagram" class="form-control display-7" value=""
                                id="instagram-formbuilder-q">
                        </div>
                        <div data-for="twitter" class="col form-group">
                            <label for="twitter-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Twitter</label>
                            <input value="{{old('twitter') ?? $shop->twitter}}" type="url" name="twitter" placeholder="https://"
                                pattern="https://.*" data-form-field="twitter" class="form-control display-7" value=""
                                id="twitter-formbuilder-q">
                        </div>
                        <div class="col form-group" data-for="linkedin">
                            <label for="linkedin-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">LinkedIn</label>
                            <input value="{{old('linkedin') ?? $shop->linkedin}}" type="url" name="linkedin" placeholder="https://"
                                pattern="https://.*" data-form-field="linkedin" class="form-control display-7" value=""
                                id="linkedin-formbuilder-q">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="adresse">
                            <label for="adresse-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Adresse ou emplacement</label>
                            <textarea name="adresse" placeholder="Adresse de votre boutique" data-form-field="adresse"
                                required="required" class="form-control display-7"
                                id="adresse-formbuilder-q">{{old('adresse') ?? $shop->adresse}}</textarea>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button type="submit" style="color: white; background: orange;"
                                class="btn display-7"><span
                                    class="mbrib-cart-add mbr-iconfont mbr-iconfont-btn"></span>Mettre à jour&nbsp;</button></div>
                    </div>
                </form>
                <!--Formbuilder Form-->
            </div>
        </div>
    </div>
</section>
@endsection