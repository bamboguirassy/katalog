@component('mail::message')
[![Logo Bambo GROUP](https://katalog.bambogroup.net/assets/images/bambogroup-50x50.jpg "Logo Bambo GROUP")](https://katalog.bambogroup.net/assets/images/katalog.png)
___
Bonjour **{{$facture->user->name}}**  
Une nouvelle facture vient d'être générée pour vous.  
__Titre__ : {{$facture->titre}}  
__Montant__ : ***{{$facture->montant}}*** FCFA  
__Date limite de paiement__ : {{date_format($facture->delai,'d/m/Y')}}  
**Description** : Une description de la facture  
**Lien Paiement** : [Lien de paiement]({{$facture->lienPaiement}} "Lien de reglement de la facture") - {{$facture->lienPaiement}}  

@component('mail::button', ['url' => $facture->lienPaiement])
Régler la facture
@endcomponent

| Si le lien de paiement ne fonctionne pas, vous pouvez copier et coller le lien suivant dans votre navigateur : {{$facture->lienPaiement}}

**Cordialement**,<br>
***{{ config('app.name') }}*** 

@endcomponent
