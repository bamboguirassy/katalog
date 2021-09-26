<div class="item features-image сol-12 col-md-6 col-lg-3">
    <div class="item-wrapper">
        <div class="item-img">
            @if ($produit->inPromo)
            <span
                class="category-badge">-{{round((1-($produit->prixPromo/$produit->prixUnitaire))*100)}}%</span>
            @endif
            <span
                class="price-badge">{{ $produit->inPromo?$produit->prixPromo:$produit->prixUnitaire }}
                FCFA</span>
            <a href="{{ route('shop.produit.display',compact('produit','shop')) }}">
                <img src="{{ asset('uploads/produits/images/'.$produit->imageCouverture->nom) }}"
                    alt="">
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
</div>