@component('mail::message')
[![Logo Bambo GROUP](https://katalog.bambogroup.net/assets/images/bambogroup-50x50.jpg "Logo Bambo GROUP")](https://katalog.bambogroup.net/assets/images/katalog.png)

Bonjour,
Votre boutique ***{{$shop->nom}}*** vient d'être créée avec succès sur la plateforme **{{ config('app.name') }}**.
Merci de faire les opérations suivantes afin de commencer à profiter pleinement desde votre boutique :
1. Accéder à votre boutique avec votre compte
2. Ajouter les differentes catégories de produits que vous vendez
3. Gérer le catalogue en ajoutant l'ensemble des produits avec des images
4. Et partager la boutique sur les réseaux sociaux, avec vos amis et vos clients
5. Commencer à recevoir vos commande

Vos informations sont les suivantes :  
- Lien d'accès à la boutique : [{{request()->getHttpHost().'/'.$shop->pseudonyme}}]({{request()->getHttpHost().'/'.$shop->pseudonyme}})  
- Email : **{{$shop->email}}**  
- Mot de passe *(à ne surtout pas partager)* : **{{ $password }}**  
> Pour tout besoin, n'hesitez pas à nous contacter sur <contact@bammbogroup.net>  
@component('mail::button', ['url' => route('shop.home',compact('shop'))])
Accédez à la boutique
@endcomponent

Cordialement,  
**{{ config('app.name') }}**

---
**{{ config('app.name') }}** est un produit de [Bambo GROUP](https://bambogroup.net)

@endcomponent
