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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection