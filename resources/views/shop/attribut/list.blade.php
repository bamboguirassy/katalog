@extends('base')

@section('title',$shop->nom." - Attributs");

@section('description',"Liste des attributs de produit")

@section('body')
<section ng-controller="AttributListController">
    <div class="row mt-5">
        <div class="col-12" ng-init="attributs={{$attributs}}">
            <section data-bs-version="5.1" class="accordion1 attorneym4_accordions1 cid-sJhuJgymAF" id="accordions1-41">
                <div class="container">
                    <div class="row">
                        <div class="col-12  col-md-12 pb-5 col-lg-12">
                            <h4 class="mbr-section-subtitle mbr-semibold align-left mbr-fonts-style display-7">Créez des
                                attributs pour ajouter plus de propriétés aux produits de votre boutique.<br>Exemple:
                                Taille, capacité, etc.</h4>
                            <h3 class="mbr-section-title align-left mbr-bold mbr-fonts-style mbr-info display-2">
                                Liste des attributs de produit</h3>

                        </div>
                        <div class="col-12">
                            <form ng-submit="addAttribut()" method="POST" class="mbr-form form-with-styler"
                                data-form-title="newAttributForm">
                                <div class="dragArea form-row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <h5 class="mbr-fonts-style display-5 text-primary">Nouvel attribut</h5>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12 col-sm-12 form-group" data-for="nom">
                                                <label for="nom-formbuilder-42"
                                                    class="form-control-label mbr-fonts-style display-7">Nom</label>
                                                <input ng-model="newAttribut.nom" type="text" name="nom"
                                                    placeholder="Nom de l'attribut" data-form-field="nom"
                                                    class="form-control display-7" required="required" value=""
                                                    id="nom-formbuilder-42">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="description">
                                        <label for="description-formbuilder-42"
                                            class="form-control-label mbr-fonts-style display-7">Description</label>
                                        <textarea ng-model="newAttribut.description" name="description"
                                            placeholder="Description de l'attribut" data-form-field="description"
                                            class="form-control display-7" id="description-formbuilder-42"></textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="changePrice">
                                        <div class="form-control-label">
                                            <label for="changePrice-formbuilder-14"
                                                class="mbr-fonts-style display-7">Est-ce que le prix du produit change
                                                en fonction de cet attribut ?</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked type="radio" name="changePrice" data-form-field="changePrice"
                                                class="form-check-input display-7" value="0"
                                                id="changePrice-formbuilder-14no">
                                            <label class="form-check-label display-7">Non</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="changePrice" data-form-field="changePrice"
                                                class="form-check-input display-7" id="changePrice-formbuilder-14yes"
                                                value="1">
                                            <label class="form-check-label display-7">Oui</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary display-7"><span
                                                class="mobi-mbri mobi-mbri-save mbr-iconfont mbr-iconfont-btn"></span>
                                            Enregistrer
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 accordion-section">
                            <div class="accordion-content">
                                <div id="bootstrap-accordion_84" class="panel-group accordionStyles accordion"
                                    role="tablist" aria-multiselectable="true">
                                    <div class="card" ng-repeat="attribut in attributs">
                                        <div class="card-header" role="tab" id="heading@{{$index}}">
                                            <a role="button" class="panel-title text-info"
                                                data-toggle="collapse" data-bs-toggle="collapse" data-core=""
                                                href="#collapse@{{$index}}_84" aria-expanded="true"
                                                aria-controls="collapse@{{$index}}">
                                                <div class="col">
                                                    <h5 class="mbr-fonts-style mbr-info display-5">
                                                        @{{attribut.nom}}</h5>
                                                </div>
                                            </a>
                                        </div>
                                        <div id="collapse@{{$index}}_84" class="panel-collapse noScroll collapse show"
                                            role="tabpanel" aria-labelledby="heading@{{$index}}"
                                            data-parent="#bootstrap-accordion_84" data-bs-parent="#accordion">
                                            <div class="panel-body ">
                                                <p class="mbr-fonts-style panel-text display-7">
                                                    @{{attribut.description}} 
                                                    <br>
                                                    <span ng-if="attribut.changePrice"><b><u>Cet attribut change le prix du produit</u></b></span>
                                                    <span ng-if="!attribut.changePrice"><b><u>Cet attribut ne change pas le prix du produit</u></b></span>
                                                    <hr>
                                                    <button style="display: inline;" ng-click="openAttributValueModal(attribut)"
                                                        title="Ajouter valeur"
                                                        class="sign mbr-iconfont fa fa-2x fa-plus inactive"></button>
                                                    <button style="display: inline;" ng-click="removeAttribut(attribut)"
                                                        title="Supprimer l'attribut"
                                                        class="btn btn-danger mbri-trash"></button>
                                                    <hr>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Nom</th>
                                                                <th>Valeur</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="valeur in attribut.valeurs">
                                                                <td scope="row">@{{valeur.nom}}</td>
                                                                <td>@{{ valeur.valeur }}
                                                                    <div ng-if="attribut.type=='couleur'"
                                                                        style="width: 50px; height: 10px; background-color: @{{valeur.valeur}}">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- modal new attribute valeur --}}
    <div class="modal mbr-popup cid-sJhAijRJkF fade" tabindex="-1" role="dialog" data-overlay-color="#000000"
        data-overlay-opacity="0.8" id="mbr-popup-44" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <h5 class="modal-title mbr-fonts-style display-5">Nouvelle valeur</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"
                            fill="currentColor">
                            <path
                                d="M13.4 12l10.3 10.3-1.4 1.4L12 13.4 1.7 23.7.3 22.3 10.6 12 .3 1.7 1.7.3 12 10.6 22.3.3l1.4 1.4L13.4 12z">
                            </path>
                        </svg>
                    </button>
                </div>

                <div class="modal-body">
                    <p class="mbr-text mbr-fonts-style display-7">
                        Ajouter des valeurs à l'attribut (<b> @{{currentAttribut.nom}}</b>)</p>
                    <div>
                        <div class="form-wrapper">
                            <!--Formbuilder Form-->
                            <form ng-submit="addNewValue()" method="POST" class="mbr-form form-with-styler"
                                data-form-title="attributValueForm">
                                <div class="">
                                </div>
                                <div class="dragArea">
                                    <div class="col-auto form-group" data-for="valeur">
                                        <label for="valeur-mbr-popup-44"
                                            class="form-control-label mbr-fonts-style display-7">Valeur</label>
                                        <input ng-model="newValue.valeur"
                                            type="@{{currentAttribut.type=='couleur'?'color':'texte'}}" name="valeur"
                                            placeholder="Valeur" data-form-field="valeur" required="required"
                                            class="form-control display-7" id="valeur-mbr-popup-44">
                                    </div>
                                    <div class="col-md-auto input-group-btn">
                                        <button type="submit" class="btn btn-primary display-4">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                            <!--Formbuilder Form-->
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    {{-- end modal new attribute valeur --}}
</section>
@endsection