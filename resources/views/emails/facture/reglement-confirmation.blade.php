@component('mail::message')
[![Logo Bambo GROUP](https://katalog.bambogroup.net/assets/images/bambogroup-50x50.jpg "Logo Bambo GROUP")](https://katalog.bambogroup.net/assets/images/bambogroup.jpg)
___
Bonjour **{{$facture->user->name}}**  
Ceci est un mail de confirmation pour vous informer que la facture **{{$facture->titre}}** est réglée avec succès.  

| Nous vous remercions  

**Cordialement**,<br>
***{{ config('app.name') }}*** 

@endcomponent