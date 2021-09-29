@extends('base')

@section('title',"Liste des boutiques");

@section('description',"")

@section('body')
<section class="mt-5">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Liste des boutiques sur {{config('app.name')}}...</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Catégorie</th>
                        <th>Date Création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shops as $shop)
                    <tr>
                        <td scope="row">{{$loop->index+1}}</td>
                        <td>{{$shop->nom}}</td>
                        <td>{{$shop->email}}</td>
                        <td>
                            <a href="https://wa.me/{{$shop->telephonePrimaire}}">{{$shop->telephonePrimaire}}</a>
                        </td>
                        <td>{{$shop->categorie->nom}}</td>
                        <td>{{date_format($shop->created_at,'d M Y')}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('shop.home',compact('shop')) }}">
                                <span class="mbri-preview"></span>
                            </a>
                            <a class="btn btn-danger" href="{{route('shop.edit', compact('shop'))}}">
                                <span class="mbri-edit2"></span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection