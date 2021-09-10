@extends('base')

@section('title',"Détails produit - ".$produit->nom);

@section('description',$produit->description)

@section('body')
<section data-bs-version="5.1" class="article5 cid-sIrEzxbcOc" id="article06-1c">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-12 col-lg">
                <div class="card-wrapper align-left">
                    <h6 class="card-title mbr-fonts-style mb-4 display-2"><strong>{{ $produit->nom }}</strong></h6>
                    <p class="mbr-text mbr-fonts-style display-7"><strong>{{ $produit->description }}</strong><br></p>
                    <div class="mbr-section-btn">
                        <a style="background: orange;" class="btn btn-lg display-4 mbr-white"
                            href="{{ route('shop.produit.edit',compact('produit','shop')) }}"><span
                                class="mobi-mbri mobi-mbri-edit mbr-iconfont mbr-iconfont-btn"></span>Modifier</a>
                        <form style="display: inline;" action="{{ route('shop.produit.destroy',compact('shop','produit')) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button style="background: red; display: inline;" class="btn btn-lg display-4 mbr-white">
                                <span class="mobi-mbri mobi-mbri-trash mbr-iconfont mbr-iconfont-btn"
                                    style="color: rgb(255, 255, 255);"></span>
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="image-wrapper">
                    <span class="price-badge">{{ $produit->prixUnitaire }} FCFA</span>
                    <span class="category-badge">{{ $produit->categorie->nom }}</span>
                    <img style="height: 400px; object-fit: cover;"
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
                Mettre à jour les photos du produit ou définir une en couverture.<br>La photo définie en couverture est
                celle vue en premier par les clients dans la boutique.</h5>
        </div>
        <div class="row mt-4">
            @foreach ($produit->images as $image)
            <div class="item features-image сol-12 col-md-6 col-lg-4">
                <div class="item-wrapper">
                    <div class="item-img">
                        <img src="{{ asset('storage/produits/images/'.$image->nom) }}">
                    </div>
                    <div class="mbr-section-btn item-footer mt-2">
                        <form style="display: inline;" action="{{ route('shop.image.destroy',compact('image','shop')) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button style="background: red; display: inline;" class="btn item-btn mbr-white" target="_blank"><span
                                    class="mobi-mbri mobi-mbri-trash mbr-iconfont mbr-iconfont-btn"></span></button>
                        </form>
                        @if ($image->id!=$produit->imageCouverture->id)
                        <a href="" class="btn item-btn btn-info" target="_blank">Mettre en couverture</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection