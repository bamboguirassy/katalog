@extends('base')

@section('title',$shop->nom." - Catalogue");

@section('description',"")

@section('body')
<div class="row">
    <div class="col-12">
        <section data-bs-version="5.1" class="info3 cid-sIqCr2MrZ5" id="info3-y">
            <div class="mbr-overlay" style="opacity: 0.6; background-color: rgb(7, 59, 76);">
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="card col-12 col-lg-10">
                        <div class="card-wrapper">
                            <div class="card-box align-center">
                                <h4 class="card-title mbr-fonts-style align-center mb-4 display-2"><strong>Mon
                                        catalogue</strong></h4>
                                <p class="mbr-text mbr-fonts-style mb-4 display-7">
                                    Gérez votre catalogue en y ajoutant vos produits ou en les mettant à jour.</p>
                                <div class="mbr-section-btn mt-3">
                                    <a class="btn btn-warning display-4"
                                        href="{{ route('shop.produit.create',compact('shop')) }}"><span
                                            class="mbri-cart-add mbr-iconfont mbr-iconfont-btn"></span>Ajouter un
                                        produit&nbsp;</a>
                                    <a class="btn btn-warning display-4"
                                        href="{{ route('shop.categorie.index',compact('shop')) }}"><span
                                            class="mbri-info mbr-iconfont mbr-iconfont-btn"></span>Gérer les catégories
                                        de produits&nbsp;</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section data-bs-version="5.1" class="gallery1 cid-sIpMwjCas3" id="gallery1-8">
            <div class="container">
                <div class="mbr-section-head">

                    <h5 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 display-7">
                        Ceci est la liste des produits que vous avez ajouté à votre stock.</h5>
                </div>
                <div class="row content-margin">
                    @foreach ($produits as $produit)
                    <div class="item features-image сol-12 col-md-6 col-lg-4">
                        <div class="item-wrapper">
                            <div class="item-img">
                                <span class="category-badge">{{ $produit->categorie->nom }}</span>
                                <span class="price-badge">{{ $produit->prixUnitaire }} FCFA</span>
                                <a
                                        href="{{ route('shop.produit.show',compact('produit','shop')) }}">
                                        <img src="{{ asset('storage/produits/images/'.$produit->imageCouverture->nom) }}"
                                    alt="{{ $produit->nom }} Photo">
                                </a>
                            </div>
                            <div class="item-content">
                                <h5 title="{{ $produit->nom }}" class="item-title mbr-fonts-style display-5">
                                    <a
                                        href="{{ route('shop.produit.show',compact('produit','shop')) }}">{{ \Illuminate\Support\Str::limit($produit->nom, 20, '...') }}</a></h5>
                                <p style="min-height: 100px" class="mbr-text mbr-fonts-style display-7">
                                    {{ \Illuminate\Support\Str::limit($produit->description, 100, '...') }}</p>
                            </div>
                            <div class="mbr-section-btn item-footer">
                                <a href="{{ route('shop.produit.edit',compact('shop','produit')) }}"
                                    class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                <form style="display: inline;" method="POST"
                                    action="{{ route('shop.produit.destroy',compact('produit','shop')) }}">
                                    @method('delete')
                                    @csrf
                                    <button style="display: inline;" class="btn btn-sm btn-danger"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if ($produits->currentPage()!=$produits->lastPage())
                    <div class="col-12">
                        <a href="{{ $produits->nextPageUrl() }}" class="btn btn-secondary pull-right mr-2">Voir plus de
                            produits</a>
                    </div>
                    @endif
                </div>
            </div>
        </section>
        <section data-bs-version="5.1" class="content11 cid-sIqE76THls" id="content11-10">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-10">
                        <div class="mbr-section-btn align-center"><a class="btn btn-primary display-4"
                                href="{{ route('shop.produit.create',compact('shop')) }}"><span
                                    class="mobi-mbri mobi-mbri-plus mbr-iconfont mbr-iconfont-btn"></span>Ajouter un
                                produit</a>
                            @if ($produits->currentPage() != $produits->lastPage())
                            <a class="btn btn-warning display-4" href="{{ $produits->nextPageUrl() }}"><span
                                    class="mbrib-more-horizontal mbr-iconfont mbr-iconfont-btn"></span>Afficher plus de
                                produit</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection