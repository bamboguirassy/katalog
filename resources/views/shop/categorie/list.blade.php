@extends('base')

@section('icon')
{{ asset('assets/images/produits-meta.jpeg') }}
@endsection

@section('title',"Catégorie de produit - ".$shop->nom);

@section('description',"Paramétrer les catégories de produits de la boutique...")

@section('body')
<section data-bs-version="5.1" class="section-table cid-sIs6gkDQqC" id="table1-1k">
    <div class="mbr-overlay" style="opacity: 0.8; background-color: rgb(255, 255, 255);">
    </div>
    <div class="container container-table">
        <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">
            <br>Catégories</h2>
        <h3 class="mbr-section-subtitle mbr-fonts-style align-center pb-2 display-7">
            Quelles sont les catégories de produits que vous vendez dans votre boutique ? <br>
            Vous pouvez ajouter les produits juste après avoir créé les catégories de produits en cliquant sur "<em>
                <a href="{{ route('shop.catalogue',compact('shop')) }}"
                    class="text-primary"><strong>Gérer le catalogue des produits</strong></a></em>".</h3>
        <div class="table-wrapper">
            <div class="container scroll">
                <table class="table isSearch" cellspacing="0" data-empty="No matching records found">
                    <thead>
                        <tr class="table-heads">
                            <th class="head-item mbr-fonts-style display-7">Nom</th>
                            <th class="head-item mbr-fonts-style display-7">Active</th>
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
                        <td class="body-item mbr-fonts-style display-7">{{ $categorie->description }}</td>
                        <td class="body-item mbr-fonts-style display-7">
                            <form action="{{ route('shop.categorie.destroy',compact('categorie','shop')) }}" method="post">
                            @method('delete')
                            @csrf
                            <button style="background: red;" method="submit" class="btn btn-sm mbr-white">
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
</section>

<section class="form cid-sIs9blqdbr" id="formbuilder-1m">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto mbr-form">
                <!--Formbuilder Form-->
                <form action="{{ route('shop.categorie.store',compact('shop')) }}" method="POST"
                    class="mbr-form form-with-styler" data-form-title="Form Name">
                    @method('post')
                    @csrf
                    <div class="form-row">
                        @foreach ($errors->all() as $message)
                        <div data-form-alert-danger="" class="alert alert-danger col-12">{{ $message }}</div>
                        @endforeach
                    </div>
                    <div class="dragArea form-row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4 class="mbr-fonts-style display-5">Ajouter une nouvelle catégorie</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div data-for="nom" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="nom-formbuilder-1m"
                                class="form-control-label mbr-fonts-style display-7">Catégorie</label>
                            <input value="{{ old('nom') }}" type="text" name="nom" placeholder="Nom catégorie"
                                data-form-field="nom" class="form-control display-7" required="required" value=""
                                id="nom-formbuilder-1m">
                        </div>
                        <div data-for="description" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="description-formbuilder-1m"
                                class="form-control-label mbr-fonts-style display-7">Description</label>
                            <textarea name="description" placeholder="Description catégorie"
                                data-form-field="description" class="form-control display-7"
                                id="description-formbuilder-1m">{{ old('description') }}</textarea>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary display-7">Enregistrer</button>
                        </div>
                    </div>
                </form>
                <!--Formbuilder Form-->
            </div>
        </div>
    </div>
</section>
@endsection