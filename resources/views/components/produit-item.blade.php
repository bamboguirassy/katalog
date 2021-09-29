<div class="col-6 col-sm-6 col-md-4 col-lg-2">
    <div class="card bg-white mt-2">
        <a href="{{ route('shop.produit.display',compact('produit','shop')) }}">
            @if ($produit->inPromo)
            <span style="font-size: 14px; padding: 2px; left: 2px;"
                class="category-badge">-{{round((1-($produit->prixPromo/$produit->prixUnitaire))*100)}}%</span>
            @endif
            @isset($produit->imageCouverture)
            <img style="height: 150px; object-fit: content;" class="card-img-top"
                src="{{ asset('uploads/produits/images/'.$produit->imageCouverture->nom) }}" alt="">
            @else
            @if(count($produit->images)>0)
            <img style="height: 150px; object-fit: content;" class="card-img-top"
                src="{{ asset('uploads/produits/images/'.$produit->images[0]->nom) }}" alt="">
            @endif
            @endisset
            <div class="card-body">
                <h6 class="card-title">{{ \Illuminate\Support\Str::limit($produit->nom, 13, '...') }}</h6>
                @if ($produit->prixSurDemande)
                <div style="background-color: red; color: white; padding: 1px;" role="alert">
                    <strong>Prix sur demande</strong>
                </div>
                @else
                <b>{{ $produit->inPromo?$produit->prixPromo:$produit->prixUnitaire }} FCFA</b>
                @endif
            </div>
        </a>
        <div class="card-footer align-center">
            @if (in_array($produit->id, $paProduits))
            <span style="background: rgb(205, 243, 205); color: white; font-size:13px;" class="btn item-btn">
                Panier &nbsp;<i class="fa fa-check"></i>
            </span>
            @else
            @if (count($produit->variants)>0 || $produit->prixSurDemande)
            <a href="{{ route('shop.produit.display',compact('produit','shop')) }}"
                class="btn btn-primary item-btn display-4 mt-0">
                Afficher
            </a>
            @else
            <a ng-click="initProductToPanier({{$produit}})" class="btn btn-sm btn-primary item-btn display-4 mt-0">
                Acheter
            </a>
            @endif
            @endif
        </div>
    </div>
</div>
{{-- <div class="item features-image сol-12 col-md-6 col-lg-3">
    <div class="item-wrapper">
        <div class="item-img">
            @if ($produit->inPromo)
            <span
                class="category-badge">-{{round((1-($produit->prixPromo/$produit->prixUnitaire))*100)}}%</span>
@endif
<span class="price-badge">{{ $produit->inPromo?$produit->prixPromo:$produit->prixUnitaire }}
    FCFA</span>
<a href="{{ route('shop.produit.display',compact('produit','shop')) }}">
    <img src="{{ asset('uploads/produits/images/'.$produit->imageCouverture->nom) }}" alt="">
</a>
</div>
<div class="item-content">
    <a href="{{ route('shop.produit.display',compact('produit','shop')) }}">
        <h5 title="{{ $produit->nom }}" class="item-title mbr-fonts-style display-4">
            <b>{{ \Illuminate\Support\Str::limit($produit->nom, 16, '...') }}</b>
        </h5>
        <p class="mbr-text mbr-fonts-style display-7 pb-2">
            <span style="font-weight: initial;">{{ $produit->categorie->nom }}</span>
        </p>
    </a>
</div>
<div class="mbr-section-btn item-footer">
    @if (in_array($produit->id, $paProduits))
    <a style="background: green; color: white;" class="btn item-btn display-4">
        Dans le panier <i class="fa fa-check"></i>
    </a>
    @else
    @if (count($produit->variants)<1) <a ng-click="initProductToPanier({{$produit}})"
        class="btn btn-primary item-btn display-4">
        Acheter
        </a>
        @else
        <a href="{{ route('shop.produit.display',compact('produit','shop')) }}"
            class="btn btn-primary item-btn display-4">
            Afficher les variantes
        </a>
        @endif
        @endif
</div>
</div>
</div> --}}