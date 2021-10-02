@extends('base')

@section('title',"Liste des boutiques");

@section('description',"")

@section('body')
<section class="mt-5">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Liste des boutiques sur {{config('app.name')}}...</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Catégorie</th>
                            <th>Date Création</th>
                            <th>Couleur</th>
                            <th>Produits</th>
                            <th>Paniers</th>
                            <th>Total Cmdes</th>
                            <th>Cmdes En attente</th>
                            <th>Cmdes Annulées</th>
                            <th>Cmdes Acceptées</th>
                            <th>Cmdes Rejetées</th>
                            <th>Cmdes Livrées</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shops as $shopItem)
                        <tr>
                            <td scope="row">{{$loop->index+1}}</td>
                            <td>
                                <a target="_blank" href="{{ route('shop.home',['shop'=>$shopItem]) }}">
                                    {{$shopItem->nom}}
                                </a>
                            </td>
                            <td>{{$shopItem->email}}</td>
                            <td style="white-space: nowrap">
                                <a href="https://wa.me/{{$shopItem->telephonePrimaire}}">{{$shopItem->telephonePrimaire}}</a>
                            </td>
                            <td>{{$shopItem->categorie->nom}}</td>
                            <td>{{date_format($shopItem->created_at,'d/m/Y')}}</td>
                            <td>
                                <div style="height: 25; width: 50px; background: {{$shopItem->couleur}}"></div>
                            </td>
                            <td>{{$shopItem->produits_count}}</td>
                            <td>{{$shopItem->paniers_count}}</td>
                            <td>{{$shopItem->commandes_count}}</td>
                            <td>{{$shopItem->commande_en_attentes_count}}</td>
                            <td>{{$shopItem->commande_annulees_count}}</td>
                            <td>{{$shopItem->commande_acceptees_count}}</td>
                            <td>{{$shopItem->commande_rejetees_count}}</td>
                            <td>{{$shopItem->commande_livrees_count}}</td>
                            <td>
                                <a target="_blank" style="padding: 3px; border: 1px solid gray; margin-right: 3px; background-color:#1C73BA; color: white;" href="{{ route('shop.home',['shop'=>$shopItem]) }}">
                                    <span class="mbri-preview"></span>
                                </a>
                                <a  style="padding: 3px; border: 1px solid gray; margin-right: 3px; background-color:orange; color: white;" href="{{route('shop.edit',['shop'=>$shopItem])}}">
                                    <span class="mbri-edit2"></span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Catégorie</th>
                            <th>Date Création</th>
                            <th>Couleur</th>
                            <th>Produits</th>
                            <th>Paniers</th>
                            <th>Total Cmdes</th>
                            <th>Cmdes En attente</th>
                            <th>Cmdes Annulées</th>
                            <th>Cmdes Acceptées</th>
                            <th>Cmdes Rejetées</th>
                            <th>Cmdes Livrées</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection