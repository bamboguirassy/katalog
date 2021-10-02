@extends('base')

@section('title','Mon profil');

@section('description',"Détails de votre compte")

@section('body')
<section data-bs-version="5.1" class="team2 cid-sK1BN2qffr" xmlns="http://www.w3.org/1999/html" id="team02-4v">
    <div class="container">
        <div class="card">
            <div class="card-wrapper card-primary">
                <div class="row align-items-center">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="image-wrapper">
                            <img src="assets/images/mbr-3.png" alt="">
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card-box align-left">
                            <h5 class="card-title mbr-fonts-style mb-3 display-2">
                                <strong>{{ $user->name }}</strong></h5>
                            <p class="mbr-text mbr-fonts-style pb-2 display-7">
                                Type Compte: {{$user->type=='owner'?'Propriétaire':'client'}}<br>
                                Email:
                                {{$user->email}}<br>
                                Membre depuis {{date_format($user->created_at,'Y')}}<br>
                                E-mail: {{$user->email}}
                                <br>Phone: {{$user->telephone}}
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@auth
@if ($user->type!='owner')
<section data-bs-version="5.1" class="info3 cid-sK1FiVEHg0" id="info3-4x">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-12 col-lg-10">
                <div class="card-wrapper">
                    <div class="card-box align-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="form cid-sK1DHE7uCK card-primary" id="formbuilder-4w">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                <!--Formbuilder Form-->
                <form action="{{ route('user.update',compact('user')) }}" method="POST"
                    class="mbr-form form-with-styler" data-form-title="Form Name">
                    <div class="form-row">
                        @method('put')
                        @csrf
                        @foreach ($errors->all() as $message)
                        <div data-form-alert-danger="" class="alert alert-danger col-12">{{$message}}</div>
                        @endforeach
                    </div>
                    <div class="dragArea form-row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4 class="mbr-fonts-style display-5">Mettre à jour mes informations</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="name">
                            <label for="name-formbuilder-4w" class="form-control-label mbr-fonts-style display-7">Nom
                                complet</label>
                            <input value="{{$user->name}}" type="text" name="name" placeholder="Nom complet"
                                data-form-field="name" class="form-control display-7" required="required" value=""
                                id="name-formbuilder-4w">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" style="" data-for="email">
                            <label for="email-formbuilder-4w"
                                class="form-control-label mbr-fonts-style display-7">Email</label>
                            <input disabled value="{{$user->email}}" type="email" name="email" placeholder="test@email.com"
                                data-form-field="email" class="form-control display-7" required="required" value=""
                                id="email-formbuilder-4w">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="telephone">
                            <label for="telephone-formbuilder-4w"
                                class="form-control-label mbr-fonts-style display-7">Téléphone</label>
                            <input value="{{$user->telephone}}" type="tel" name="telephone"
                                placeholder="+221 xx xxx xx xx" data-form-field="telephone" required="required"
                                class="form-control display-7" max="100" min="0" step="1" value=""
                                id="telephone-formbuilder-4w">
                        </div>
                        <div class="col" style="">
                            <button type="submit" class="btn btn-secondary display-7">Mettre à
                                jour</button>
                        </div>
                    </div>
                </form>
                <!--Formbuilder Form-->
            </div>
        </div>
    </div>
</section>
@endif
@endauth


<section class="form cid-sK1AHb7KTV" id="formbuilder-4t">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto mbr-form">
                <!--Formbuilder Form-->
                <form action="{{ route('user.update.password') }}" method="POST" class="mbr-form form-with-styler"
                    data-form-title="passwordEdit">
                    @method('post')
                    @csrf
                    <div class="form-row">
                        @foreach ($errors->all() as $message)
                        <div data-form-alert-danger="" class="alert alert-danger col-12">{{$message}}</div>
                        @endforeach
                    </div>
                    <div class="dragArea form-row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4 class="mbr-fonts-style display-2">Changer mot de passe</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="currentPassword">
                            <label for="currentPassword-formbuilder-4t"
                                class="form-control-label mbr-fonts-style display-7"><strong>Mot de passe
                                    actuel</strong></label>
                            <input type="password" name="currentPassword" placeholder="Mot de passe actuel"
                                data-form-field="currentPassword" required="required" class="form-control display-7"
                                value="" id="currentPassword-formbuilder-4t">
                        </div>
                        <div data-for="password" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="password-formbuilder-4t"
                                class="form-control-label mbr-fonts-style display-7"><strong>Nouveau mot de
                                    passe</strong></label>
                            <input type="password" name="password" placeholder="Nouveau mot de passe"
                                data-form-field="password" class="form-control display-7" required="required" value=""
                                id="password-formbuilder-4t">
                        </div>
                        <div data-for="password_confirmation" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="password_confirmation-formbuilder-4t"
                                class="form-control-label mbr-fonts-style display-7"><strong>Confirmation mot de
                                    passe</strong></label>
                            <input type="password" name="password_confirmation"
                                placeholder="Confirmation nouveau mot de passe" data-form-field="password_confirmation"
                                class="form-control display-7" required="required" value=""
                                id="password_confirmation-formbuilder-4t">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div class="col"><button type="submit" class="btn btn-secondary display-7">Appliquer les
                                changements</button></div>
                    </div>
                </form>
                <!--Formbuilder Form-->
            </div>
        </div>
    </div>
</section>
@endsection