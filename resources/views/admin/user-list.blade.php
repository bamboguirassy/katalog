@extends('base')

@section('title',"Liste des utilisateurs");

@section('description',"")

@section('body')
<section class="mt-5">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Liste des users sur {{config('app.name')}}...</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom complet</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Type</th>
                            <th>Date Création</th>
                            <th>Paniers</th>
                            <th>Total Cmdes</th>
                            <th>Cmdes En attente</th>
                            <th>Cmdes Annulées</th>
                            <th>Cmdes Acceptées</th>
                            <th>Cmdes Rejetées</th>
                            <th>Cmdes Livrées</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td scope="row">{{$loop->index+1}}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->telephone }}</td>
                            <td>{{ $user->type }}</td>
                            <td>{{ date_format($user->created_at,'d M Y') }}</td>
                            <td>{{$user->paniers_count}}</td>
                            <td>{{$user->commandes_count}}</td>
                            <td>{{$user->commande_en_attentes_count}}</td>
                            <td>{{$user->commande_annulees_count}}</td>
                            <td>{{$user->commande_acceptees_count}}</td>
                            <td>{{$user->commande_rejetees_count}}</td>
                            <td>{{$user->commande_livrees_count}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection