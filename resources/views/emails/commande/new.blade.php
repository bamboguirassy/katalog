@component('mail::message')
[![Logo {{$commande->shop->nom}}]({{asset('storage/shops/'.$commande->shop->logo)}} "Logo {{$commande->shop->nom}}")]({{asset('storage/shops/'.$commande->shop->logo)}})

Bonjour ***{{$commande->user->name}}***,
Bienvenue chez **{{$commande->shop->nom}}**.
Nous avons reçu avec succès votre commande numéro **{{$commande->numero}}** passée dans notre boutique.
Nous allons vous revenir très prochainement.
Cordialement.

---
**Katalog** est un produit de [Bambo GROUP](https://bambogroup.net)
@endcomponent
