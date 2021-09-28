@extends('base')

@section('icon')
{{ asset('assets/images/produits-meta.jpeg') }}
@endsection

@section('title',"Catégorie de produit - ".$shop->nom);

@section('description',"Paramétrer les catégories de produits de la boutique...")

@section('body')
<section ng-controller="CategorieController" ng-init="init({{$categories}})" data-bs-version="5.1"
    class="section-table cid-sIs6gkDQqC" id="table1-1k">
    <div class="mbr-overlay" style="opacity: 0.8; background-color: rgb(255, 255, 255);">
    </div>
    <div class="container container-table">
        <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">
            <br>Catégories</h2>
        <h3 class="mbr-section-subtitle mbr-fonts-style align-center pb-2 display-7">
            Quelles sont les catégories de produits que vous vendez dans votre boutique ? <br>
            Vous pouvez ajouter les produits juste après avoir créé les catégories de produits en cliquant sur "<em>
                <a href="{{ route('shop.catalogue',compact('shop')) }}" class="text-primary"><strong>Gérer le catalogue
                        des produits</strong></a></em>".</h3>
        <div class="table-wrapper">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <section class="form cid-sIs9blqdbr" id="formbuilder-1m">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 mx-auto mbr-form" ng-if="selected==null">
                                    <!--new Formbuilder Form-->
                                    <form action="{{ route('shop.categorie.store',compact('shop')) }}" method="POST"
                                        class="mbr-form form-with-styler" data-form-title="Form Name">
                                        @method('post')
                                        @csrf
                                        <div class="form-row">
                                            @foreach ($errors->all() as $message)
                                            <div data-form-alert-danger="" class="alert alert-danger col-12">
                                                {{ $message }}</div>
                                            @endforeach
                                        </div>
                                        <div class="dragArea form-row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <h4 class="mbr-fonts-style display-5">Ajouter une catégorie</h4>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <hr>
                                            </div>
                                            <div data-for="categorie_id"
                                                class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <label for="categorie_id-formbuilder-1m"
                                                    class="form-control-label mbr-fonts-style display-7">Catégorie
                                                    parente (optionnel)</label>
                                                <select name="categorie_id" data-form-field="categorie_id"
                                                    class="form-control display-7" id="categorie_id-formbuilder-1m">
                                                    <option value="" style="text-align: center;">---</option>
                                                    @foreach ($categories as $categorie)
                                                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div data-for="nom" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <label for="nom-formbuilder-1m"
                                                    class="form-control-label mbr-fonts-style display-7">Catégorie</label>
                                                <input value="{{ old('nom') }}" type="text" name="nom"
                                                    placeholder="Nom catégorie" data-form-field="nom"
                                                    class="form-control display-7" required="required" value=""
                                                    id="nom-formbuilder-1m">
                                            </div>
                                            <div data-for="description"
                                                class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <label for="description-formbuilder-1m"
                                                    class="form-control-label mbr-fonts-style display-7">Description</label>
                                                <textarea name="description" placeholder="Description catégorie"
                                                    data-form-field="description" class="form-control display-7"
                                                    id="description-formbuilder-1m">{{ old('description') }}</textarea>
                                            </div>
                                            <div class="col">
                                                <button type="submit"
                                                    class="btn btn-primary display-7">Enregistrer</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--end new Formbuilder Form-->
                                </div>
                                <div ng-show="selected!=null" class="col-lg-10 mx-auto mbr-form">
                                    <!--edit Formbuilder Form-->
                                    <form id="catEditForm" method="post"
                                        class="mbr-form form-with-styler" data-form-title="Form Name">
                                        @method('put')
                                        @csrf
                                        <div class="form-row">
                                            @foreach ($errors->all() as $message)
                                            <div data-form-alert-danger="" class="alert alert-danger col-12">
                                                {{ $message }}</div>
                                            @endforeach
                                        </div>
                                        <div class="dragArea form-row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <h4 class="mbr-fonts-style display-5">Modifier la catégorie</h4>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <hr>
                                            </div>
                                            <div data-for="categorie_id"
                                                class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <label for="categorie_id-formbuilder-1me"
                                                    class="form-control-label mbr-fonts-style display-7">Catégorie
                                                    parente (optionnel)</label>
                                                <select name="categorie_id" data-form-field="categorie_id"
                                                    class="form-control display-7" id="categorie_id-formbuilder-1me">
                                                    <option value="" style="text-align: center;">---</option>
                                                    <option ng-selected="selected.categorie_id==categorie.id"
                                                        ng-repeat="categorie in categories"
                                                        ng-value="categorie.id ">@{{categorie.nom}}</option>
                                                </select>
                                            </div>
                                            <div data-for="nom" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <label for="nom-formbuilder-1me"
                                                    class="form-control-label mbr-fonts-style display-7">Catégorie</label>
                                                <input value="@{{selected.nom}}" type="text" name="nom"
                                                    placeholder="Nom catégorie" data-form-field="nom"
                                                    class="form-control display-7" required="required" value=""
                                                    id="nom-formbuilder-1me">
                                            </div>
                                            <div data-for="description"
                                                class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <label for="description-formbuilder-1me"
                                                    class="form-control-label mbr-fonts-style display-7">Description</label>
                                                <textarea name="description" placeholder="Description catégorie"
                                                    data-form-field="description" class="form-control display-7"
                                                    id="description-formbuilder-1me">@{{selected.description}}</textarea>
                                            </div>
                                            <div class="col">
                                                <button ng-click="submitEditForm()" id="catEditBtn" style="display: inline;background-color: orange; color: white;"
                                                    type="button" class="btn">Modifier</button>
                                                <button style="display: inline;" ng-click="cancelEdit()" type="submit"
                                                    class="btn btn-secondary">Annuler</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--end edit Formbuilder Form-->
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-12 col-lg-6" ng-if="selected==null">
                    <div class="container scroll">
                        <table class="table isSearch" cellspacing="0" data-empty="No matching records found">
                            <thead>
                                <tr class="table-heads">
                                    <th class="head-item mbr-fonts-style display-7">Nom</th>
                                    <th class="head-item mbr-fonts-style display-7">Active</th>
                                    <th class="head-item mbr-fonts-style display-7">Parent</th>
                                    <th class="head-item mbr-fonts-style display-7">Description</th>
                                    <th class="head-item mbr-fonts-style display-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            @foreach ($categories as $categorie)
                            <tr>
                                <td class="body-item mbr-fonts-style display-7">{{ $categorie->nom }}</td>
                                <td class="body-item mbr-fonts-style display-7">
                                    @if ($categorie->active)
                                    <b>Oui</b>
                                    @else
                                    <div class="alert alert-primary" role="alert">
                                        <strong>Non</strong>
                                    </div>
                                    @endif
                                </td>
                                <td class="body-item mbr-fonts-style display-7">
                                    @if($categorie->parent!=null)
                                    {{ $categorie->parent->nom }}
                                    @endif
                                </td>
                                <td class="body-item mbr-fonts-style display-7">{{ $categorie->description }}</td>
                                <td class="body-item mbr-fonts-style display-7">
                                    <button ng-click="setSelected({{$categorie}})" type="button" class="btn"
                                        style="background: orange; color: white;">
                                        <span class="mbri-edit2"></span>
                                    </button>
                                    <form style="display: inline;"
                                        action="{{ route('shop.categorie.destroy',compact('categorie','shop')) }}"
                                        method="post">
                                        @method('delete')
                                        @csrf
                                        <button style="background: red; display: inline;" method="submit"
                                            class="btn btn-sm mbr-white">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection