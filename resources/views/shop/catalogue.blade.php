@extends('base')

@section('title',$shop->nom." - Catalogue");

@section('description',"")

@section('body')
<div class="row">
    <div class="col-12">
        <section data-bs-version="5.1" class="info3 cid-sIqCr2MrZ5" id="info3-y">
            <div class="mbr-overlay" style="opacity: 0.6; background-color: #1C73BA;">
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="card col-12 col-lg-10">
                        <div class="card-wrapper">
                            <div class="card-box align-center">
                                <h4 class="card-title mbr-fonts-style align-center mb-4 display-2">
                                    <strong>Mon
                                        catalogue</strong></h4>
                                <p class="mbr-text mbr-fonts-style mb-4 display-7">
                                    Gérez votre catalogue en y ajoutant vos produits ou en les mettant à jour.</p>
                                <div class="mbr-section-btn mt-3">
                                    <a class="btn btn-primary display-4"
                                        href="{{ route('shop.produit.create',compact('shop')) }}"><span
                                            class="mbri-plus mbr-iconfont mbr-iconfont-btn"></span>Ajouter un
                                        produit&nbsp;</a>
                                    <a class="btn btn-primary display-4"
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
                    @if (count($produits)<1) <div
                        style="height: 100px; line-height: 100px; font-size: 25px; background: white; color: #196B86; text-align: center; float: center;">
                        La boutique est vide pour l'instant !
                </div>
                @endif
            </div>
            <div class="row content-margin">
                @foreach ($produits as $produit)
                <div class="item features-image сol-12 col-md-6 col-lg-4">
                    <div class="item-wrapper">
                        <div class="item-img">
                            @if ($produit->inPromo)
                            <span
                                class="category-badge">-{{round((1-($produit->prixPromo/$produit->prixUnitaire))*100)}}%</span>
                            @endif
                            <span class="price-badge">{{ $produit->inPromo?$produit->prixPromo:$produit->prixUnitaire }}
                                FCFA</span>
                            <a href="{{ route('shop.produit.show',compact('produit','shop')) }}">
                                <img src="{{ asset('uploads/produits/images/'.$produit->imageCouverture->nom) }}"
                                    alt="{{ $produit->nom }} Photo">
                            </a>
                        </div>
                        <div class="item-content">
                            <h5 title="{{ $produit->nom }}" class="item-title mbr-fonts-style display-4">
                                <a
                                    href="{{ route('shop.produit.show',compact('produit','shop')) }}">{{ \Illuminate\Support\Str::limit($produit->nom, 20, '...') }}</a>
                            </h5>
                            <p class="mbr-text mbr-fonts-style display-7">
                                {{ $produit->categorie->nom }}</p>
                        </div>
                        <div class="mbr-section-btn item-footer">
                            <a href="{{ route('shop.produit.edit',compact('shop','produit')) }}" class="btn btn-primary"
                                style="margin-right: 2px;"><i class="fa fa-edit"></i></a>
                            <form style="display: inline;" method="POST"
                                action="{{ route('shop.produit.destroy',compact('produit','shop')) }}">
                                @method('delete')
                                @csrf
                                <button style="display: inline;" class="btn btn-danger"><i
                                        class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-12">
                    @if ($produits->currentPage()!=$produits->lastPage())
                    <a href="{{ $produits->nextPageUrl() }}" class="btn btn-secondary pull-right mr-2">Page suivante</a>
                    @endif
                    @if ($produits->currentPage() != 1)
                    <a class="btn btn-secondary ml-2" href="{{ $produits->previousPageUrl() }}"><span
                            class="mbrib-more-horizontal mbr-iconfont mbr-iconfont-btn"></span>Page précédente</a>
                    @endif
                </div>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
@endsection