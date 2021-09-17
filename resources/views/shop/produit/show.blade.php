@extends('base')

@section('title',"Détails produit - ".$produit->nom);

@section('description',$produit->description)

@section('body')
<section data-bs-version="5.1" class="article5 cid-sIrEzxbcOc" id="article06-1c">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-wrapper align-left">
                        <h6 class="card-title mbr-fonts-style mb-4 display-2"><strong>{{ $produit->nom }}</strong></h6>
                        <p class="mbr-text mbr-fonts-style display-7"><strong>{{ $produit->description }}</strong><br>
                        </p>
                        <div class="mbr-section-btn">
                            <a style="background: orange;" class="btn btn-lg display-4 mbr-white"
                                href="{{ route('shop.produit.edit',compact('produit','shop')) }}"><span
                                    class="mobi-mbri mobi-mbri-edit mbr-iconfont mbr-iconfont-btn"></span>Modifier</a>
                            <form style="display: inline;"
                                action="{{ route('shop.produit.destroy',compact('shop','produit')) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button style="background: red; display: inline;"
                                    class="btn btn-lg display-4 mbr-white">
                                    <span class="mobi-mbri mobi-mbri-trash mbr-iconfont mbr-iconfont-btn"
                                        style="color: rgb(255, 255, 255);"></span>
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="image-wrapper">
                    <span class="price-badge">{{ $produit->prixUnitaire }} FCFA</span>
                    <span class="category-badge">{{ $produit->categorie->nom }}</span>
                    <img style="height: 400px;"
                        src="{{ asset('storage/produits/images/'.$produit->imageCouverture->nom) }}"
                        alt="Image de couverture">
                </div>
            </div>
        </div>
    </div>
</section>
<section data-bs-version="5.1" class="gallery2 cid-sIDTM1YNga" id="gallery2-1t">
    <div class="container">
        <div class="mbr-section-head">

            <h5 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 mt-2 display-5">
                Mettre à jour les photos du produit ou définir une en couverture.<br>L'image définie en couverture est
                celle vue en premier par les clients dans la boutique pour chaque produit.</h5>
        </div>
        <div class="row mt-4">
            @foreach ($produit->images as $image)
            <div class="item features-image сol-12 col-md-6 col-lg-4">
                <div class="item-wrapper">
                    <div class="item-img">
                        <img src="{{ asset('storage/produits/images/'.$image->nom) }}">
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
                        <span class="btn item-btn btn-info" style="color: green;">Actuellement en couverture du
                            produit</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
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
                            name="photos[]" placeholder="Sélectionner des photos du produit" data-form-field="photos"
                            required="required" class="form-control display-7" value="" id="photos-formbuilder-14">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                    </div>
                    <button name="" id="" class="btn btn-primary" role="button">Téléverser</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection