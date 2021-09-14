@extends('base')

@section('icon')
{{ asset('assets/images/produits-meta.jpeg') }}
@endsection

@section('title',"Détails Boutique - ".$shop->nom);

@section('description',$shop->description)

@section('body')
<section data-bs-version="5.1" class="content5 cid-sIqITZHSZd" id="extContacts5-19">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card-img">
                    <span class="category-item">{{ $shop->categorie->nom }}</span>
                    <img style="max-height: 500px; object-fit: cover;" src="{{ asset('storage/shops/'.$shop->logo) }}"
                        alt="">
                </div>
            </div>
            <div class="col-lg-4">
                <h4 class="card-title mbr-semibold pb-2 align-left mbr-fonts-style display-5"><br>
                    {{ $shop->nom }}
                </h4>
                <p class="mbr-text align-left mbr-fonts-style display-4">
                    {{ $shop->description }}
                </p>
                <p class="items items-col align-left mbr-fonts-style display-4">
                    <strong>CODE UNIQUE:</strong> &nbsp;{{ $shop->pseudonyme }}<br>
                    <strong>CATEGORIE:</strong> &nbsp;{{ $shop->categorie->nom }}<br>
                    <strong>DATE ACCES:</strong>&nbsp;{{ date_format($shop->created_at,'d M, Y') }}<br></p>
                <div class="social-list pt-2 align-left">
                    <p class="items align-left mbr-fonts-style display-4">
                        <strong>PARTAGER:&nbsp;</strong>
                    </p>
                    @isset($shop->twitter)
                    <div class="soc-item">
                        <a href="{{ $shop->twitter }}" target="_blank">
                            <span class="mbr-iconfont mbr-iconfont-social socicon-twitter socicon"></span>
                        </a>
                    </div>
                    @endisset
                    @isset($shop->facebook)
                    <div class="soc-item">
                        <a href="{{ $shop->facebook }}" target="_blank">
                            <span class="mbr-iconfont mbr-iconfont-social socicon-facebook socicon"></span>
                        </a>
                    </div>
                    @endisset
                    @isset($shop->instagram)
                    <div class="soc-item">
                        <a href="{{ $shop->instagram }}" target="_blank">
                            <span class="mbr-iconfont mbr-iconfont-social socicon-instagram socicon"></span>
                        </a>
                    </div>
                    @endisset
                    @isset($shop->linkedin)
                    <div class="soc-item">
                        <a href="{{ $shop->linkedin }}" target="_blank">
                            <span class="mbr-iconfont mbr-iconfont-social socicon-linkedin socicon"></span>
                        </a>
                    </div>
                    @endisset
                </div>
                @auth
                @if (auth()->user()->type=='owner' && auth()->user()->shop->id==$shop->id)
                <div class="col-12">
                    <button class="btn mt-2 mbr-white" style="background: orange;">Modifier &nbsp; <i
                            class="fa fa-edit"></i></button>
                </div>
                @endif
                @endauth
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="contacts1 cid-sIrPBkLOUh" id="contacts01-1e">
    <div class="container">
        <div class="mbr-section-head pb-4">
            <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">Contacts
            </h3>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="card col-12 col-md-6">
                <div class="card-wrapper">
                    <div class="image-wrapper">
                        <span class="mbr-iconfont mobi-mbri-phone mobi-mbri"></span>
                    </div>
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style mb-1 display-5">
                            Téléphone Primaire
                        </h6>
                        <p class="mbr-text mbr-fonts-style display-7">
                            <a href="tel:{{ $shop->telephonePrimaire }}" class="text-success">{{ $shop->telephonePrimaire }}</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card col-12 col-md-6">
                <div class="card-wrapper">
                    <div class="image-wrapper">
                        <span class="mbr-iconfont mobi-mbri-letter mobi-mbri"></span>
                    </div>
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style mb-1 display-5">
                            Email
                        </h6>
                        <p class="mbr-text mbr-fonts-style display-7">
                            <a href="mailto:{{ $shop->email }}" class="text-success">{{ $shop->email }}</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card col-12 col-md-6">
                <div class="card-wrapper">
                    <div class="image-wrapper">
                        <span class="mbr-iconfont mobi-mbri-globe mobi-mbri"></span>
                    </div>
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style mb-1 display-5">
                            Adresse
                        </h6>
                        <p class="mbr-text mbr-fonts-style display-7">
                            {{ $shop->adresse }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="card col-12 col-md-6">
                <div class="card-wrapper">
                    <div class="image-wrapper">
                        <span class="mbr-iconfont mobi-mbri-bulleted-list mobi-mbri"></span>
                    </div>
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style mb-1 display-5">
                            Téléphone sécondaire
                        </h6>
                        <p class="mbr-text mbr-fonts-style display-7">
                            @isset($shop->telephoneSecondaire)
                            <a href="tel:{{ $shop->telephoneSecondaire }}" class="text-success">{{ $shop->telephoneSecondaire }}</a>
                            @else
                            Non renseigné
                            @endisset
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection