@extends('base')

@section('title',"Nouvelle Boutique");

@section('description',"Créer votre boutique dès aujourd'hui sur ".config('app.name'))

@section('body')
<section data-bs-version="5.1" class="header3 agencym4_header3 cid-sIqqheaqtl" id="header3-p">
    <div class="container align-center">
        <div class="row justify-content-center">
            <div class="media-container-column mbr-white col-md-10">
                <h3 class="mbr-section-subtitle align-center mbr-light pb-1 mbr-fonts-style display-2">
                    Booster mon commerce,<br>C'est maintenant !</h3>
                <h1 class="mbr-section-title mbr-bold pb-1 mbr-fonts-style display-1">
                    Créez votre boutique !</h1>
                <p class="mbr-text pb-2 mbr-fonts-style display-7">
                    Et essayez <b>{{ config('app.name') }}</b> gratuitement...</p>
            </div>
        </div>
    </div>

</section>

<section class="form cid-sIqqPj8uvi" id="formbuilder-q" ng-controller="ShopNewController">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto mbr-form">
                <!--Formbuilder Form-->
                <form action="{{route('shop.store')}}" method="POST" class="mbr-form form-with-styler"
                    data-form-title="boutiqueNewForm" enctype="multipart/form-data">
                    @method('post')
                    @csrf
                    <div class="form-row">
                        <div hidden="hidden" data-form-alert="" class="alert alert-success col-12"></div>
                        @foreach ($errors->all() as $message)
                        <div data-form-alert-danger="" class="alert alert-danger col-12">{{$message}}</div>
                        @endforeach
                    </div>
                    <div class="dragArea form-row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4 class="mbr-fonts-style display-5">Formulaire de création de boutique</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div data-for="nom" class="col-lg-12 col-md-12 col-sm-12 form-group" style="">
                            <label for="nom-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Nom</label>
                                <input ng-model="nom" ng-change="handleShopNameChange(nom)" value="{{old('nom')}}" type="text" name="nom" placeholder="Nom de la boutique" data-form-field="nom"
                                class="form-control display-7" required="required" value="" id="nom-formbuilder-q">
                        </div>
                        <div data-for="pseudonyme" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="pseudonyme-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Pseudonyme (Ceci est l'identifiant de la boutique)</label>
                            <input style="color: blue;" ng-model="pseudonyme" value="{{old('pseudonyme')}}" type="text" name="pseudonyme" placeholder="Pseudonyme de votre boutique"
                                data-form-field="pseudonyme" class="form-control display-7" required="required" value=""
                                id="pseudonyme-formbuilder-q">
                                <span style="margin-top: 3px;" ng-if="pseudonyme!=''">Le lien de votre boutique sera : <b style="color: blue;">{{request()->getHttpHost()}}/[[pseudonyme]]</b></span>
                        </div>
                        <div data-for="categorie" class="col-lg-12 col-md-12 col-sm-12 form-group" style="">
                            <label for="categorie-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Quelle catégorie de produit vous
                                vendez ?</label>
                            <select value="{{old('categorie_id')}}" name="categorie_id" data-form-field="categorie" class="form-control display-7"
                                id="categorie-formbuilder-q">
                                @foreach ($types as $type)
                                <option value="{{$type->id}}">{{$type->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" style="" data-for="logo">
                            <label for="logo-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Téléverser le logo (si vous en
                                avez)</label>
                            <input value="{{old('logo')}}" type="file" accept="image/*" name="logo" data-form-field="logo"
                                class="form-control display-7" value="" id="logo-formbuilder-q">
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
                            <input value="{{old('telephonePrimaire')}}" type="tel" name="telephonePrimaire" placeholder="Numéro de téléphone primaire"
                                data-form-field="telephonePrimaire" class="form-control display-7" pattern="*"
                                required="required" value="" id="telephonePrimaire-formbuilder-q">
                        </div>
                        <div data-for="telephoneSecondaire" class="col form-group">
                            <label for="telephoneSecondaire-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Téléphone Secondaire</label>
                            <input value="{{old('telephoneSecondaire')}}" type="tel" name="telephoneSecondaire" placeholder="Numéro de téléphone sécondaire"
                                data-form-field="telephoneSecondaire" class="form-control display-7" value=""
                                id="telephoneSecondaire-formbuilder-q">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="description">
                            <label for="description-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Description</label>
                            <textarea name="description" placeholder="Parlez nous un peu de votre boutique."
                                data-form-field="description" required="required" class="form-control display-7"
                                id="description-formbuilder-q">{{old('description')}}</textarea>
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
                            <input value="{{old('facebook')}}" type="url" name="facebook" placeholder="https://" pattern="https://.*"
                                data-form-field="facebook" class="form-control display-7" value=""
                                id="facebook-formbuilder-q">
                        </div>
                        <div data-for="instagram" class="col form-group">
                            <label for="instagram-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Instagram</label>
                            <input value="{{old('instagram')}}" type="url" name="instagram" placeholder="https://" pattern="https://.*"
                                data-form-field="instagram" class="form-control display-7" value=""
                                id="instagram-formbuilder-q">
                        </div>
                        <div data-for="twitter" class="col form-group">
                            <label for="twitter-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Twitter</label>
                            <input value="{{old('twitter')}}" type="url" name="twitter" placeholder="https://" pattern="https://.*"
                                data-form-field="twitter" class="form-control display-7" value=""
                                id="twitter-formbuilder-q">
                        </div>
                        <div class="col form-group" data-for="linkedin">
                            <label for="linkedin-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">LinkedIn</label>
                            <input value="{{old('linkedin')}}" type="url" name="linkedin" placeholder="https://" pattern="https://.*"
                                data-form-field="linkedin" class="form-control display-7" value=""
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
                                id="adresse-formbuilder-q">{{old('adresse')}}</textarea>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p class="mbr-fonts-style display-7">Informations de connexion</p>
                        </div>
                        <div data-for="email" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="email-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Email</label>
                            <input value="{{old('email')}}" type="email" name="email" placeholder="Email" data-form-field="email"
                                required="required" class="form-control display-7" value="" id="email-formbuilder-q">
                        </div>
                        <div data-for="password" class="col form-group">
                            <label for="password-formbuilder-q" class="form-control-label mbr-fonts-style display-7">Mot
                                de passe</label>
                            <input type="password" name="password" placeholder="Mot de passe" data-form-field="password"
                                required="required" class="form-control display-7" value="" id="password-formbuilder-q">
                        </div>
                        <div class="col form-group" data-for="password_confirmation">
                            <label for="password_confirmation-formbuilder-q"
                                class="form-control-label mbr-fonts-style display-7">Confirmation mot de passe</label>
                            <input type="password" name="password_confirmation" placeholder="Confirmation mot de passe"
                                data-form-field="password_confirmation" required="required"
                                class="form-control display-7" value="" id="password_confirmation-formbuilder-q">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12"><button type="submit"
                                class="btn btn-primary display-7"><span
                                    class="mbrib-cart-add mbr-iconfont mbr-iconfont-btn"></span>Créer ma
                                boutique&nbsp;</button></div>
                    </div>
                </form>
                <!--Formbuilder Form-->
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="social1 cid-sIqxxOSjaa" id="share1-r">
    <div class="container">
        <div class="media-container-row">
            <div class="col-12">
                <h3 class="mbr-section-title mb-3 align-center mbr-fonts-style display-2">
                    <strong>Partager cette page !</strong>
                </h3>
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