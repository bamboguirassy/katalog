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
                            <th>Produits</th>
                            <th>Paniers</th>
                            <th>Total Commandes</th>
                            <th>Commandes En attente</th>
                            <th>Commandes Acceptées</th>
                            <th>Commandes Rejetées</th>
                            <th>Commandes Livrées</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shops as $shop)
                        <tr>
                            <td scope="row">{{$loop->index+1}}</td>
                            <td>{{$shop->nom}}</td>
                            <td>{{$shop->email}}</td>
                            <td style="white-space: nowrap">
                                <a href="https://wa.me/{{$shop->telephonePrimaire}}">{{$shop->telephonePrimaire}}</a>
                            </td>
                            <td>{{$shop->categorie->nom}}</td>
                            <td>{{date_format($shop->created_at,'d/m/Y')}}</td>
                            <td>{{$shop->produits_count}}</td>
                            <td>{{$shop->paniers_count}}</td>
                            <td>{{$shop->commandes_count}}</td>
                            <td>{{$shop->commande_en_attentes_count}}</td>
                            <td>{{$shop->commande_acceptees_count}}</td>
                            <td>{{$shop->commande_rejetees_count}}</td>
                            <td>{{$shop->commande_livrees_count}}</td>
                            <td>
                                <a style="padding: 3px; border: 1px solid gray; margin-right: 3px; background-color:#1C73BA; color: white;" href="{{ route('shop.home',compact('shop')) }}">
                                    <span class="mbri-preview"></span>
                                </a>
                                <a  style="padding: 3px; border: 1px solid gray; margin-right: 3px; background-color:orange; color: white;" href="{{route('shop.edit', compact('shop'))}}">
                                    <span class="mbri-edit2"></span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection