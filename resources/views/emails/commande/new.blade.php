@component('mail::message')
[![Logo {{$commande->shop->nom}}]({{asset('uploads/shops/'.$commande->shop->logo)}} "Logo {{$commande->shop->nom}}")]({{asset('uploads/shops/'.$commande->shop->logo)}})

Bonjour ***{{$commande->user->name}}***,
Bienvenue chez **{{$commande->shop->nom}}**.
Nous avons reçu avec succès votre commande numéro **{{$commande->numero}}** passée dans notre boutique.  
|  Produit | Image | Quantité |
|---|---|---|
@foreach ($commande->produits as $produit)
|  {{$produit->produit->nom}} |   @if(count($produit->produit->images)>0) [![]({{asset('uploads/produits/images/'.$produit->produit->images[0]->nom)}} "{{$produit->produit->nom}}")]({{asset('uploads/produits/images/'.$produit->produit->images[0]->nom)}}) @endif | {{$produit->quantite}} unité(s) |
@endforeach
Nous serez notifiés de la suite de la commande.  

Vous pouvez suivre l'évolution de la commande en cliquant sur le bouton suivant :  
@component('mail::button', ['url' => route('shop.commande.show',['shop'=>$commande->shop,'commande'=>$commande])])
Accèder à la commande
@endcomponent

Cordialement,  
{{$commande->shop->nom}}

---
**Katalog** est un produit de [Bambo GROUP](https://bambogroup.net)
@endcomponent
