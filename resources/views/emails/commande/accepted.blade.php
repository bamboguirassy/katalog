@component('mail::message')
[![Logo {{$commande->shop->nom}}]({{asset('uploads/shops/'.$commande->shop->logo)}} "Logo {{$commande->shop->nom}}")]({{asset('uploads/shops/'.$commande->shop->logo)}})

Bonjour **Moussa FOFANA**,  
Vous avez passé la commande numéro __125856658__ dans notre boutique.  
Elle vient d'être confirmée. 
| Détails commande  
|  Produit | Image | Quantité |
|---|---|---|
@foreach ($commande->produits as $produit)
|  {{$produit->produit->nom}} |   @if(count($produit->produit->images)>0) [![]({{asset('uploads/produits/images/'.$produit->produit->images[0]->nom)}} "{{$produit->produit->nom}}")]({{asset('uploads/produits/images/'.$produit->produit->images[0]->nom)}}) @endif | {{$produit->quantite}} unité(s) |
@endforeach

@component('mail::button', ['url' => route('shop.commande.show',['shop'=>$commande->shop,'commande'=>$commande])])
Suivre la commande
@endcomponent

Cordialement,  
**{{$commande->shop->nom}}**

---
**Katalog** est un produit de [Bambo GROUP](https://bambogroup.net)
@endcomponent
