@component('mail::message')
[![Logo Bambo GROUP](https://katalog.bambogroup.net/assets/images/bambogroup-50x50.jpg "Logo Bambo GROUP")](https://katalog.bambogroup.net/assets/images/bambogroup.jpg)


Bonjour **{{$user->name}}**,
Bienvenue sur la plateforme ***{{ config('app.name') }}***.
Votre compte est créé avec succès. Veuillez trouver ci-dessous vos identifiants de connexion: 
- Email: **{{$user->email}}**
- Mot de passe (à ne surtout pas partager): **{{$password}}**

Vous pourrez naviguer avec ce compte sur toutes les boutiques de la plateforme, passer des commandes et suivre vos commandes.

Cordialement.

---
**Katalog** est un produit de [Bambo GROUP](https://bambogroup.net)
@endcomponent
