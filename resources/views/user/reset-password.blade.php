@extends('base')

@section('title','Réinitialisation mot de passe');

@section('description',"Page de changement du mot de passe de l'utilisateur après demande de réinitialisation")

@section('body')
<section data-bs-version="5.1" class="content3 cid-sK1Js0NrUL" id="content03-56">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md">
                <h5 class="mbr-section-title mbr-fonts-style mb-4 display-5">Réinitialisation du mot de passe</h5>
            </div>
            <div class="col-md-12 col-lg-8">
                <p class="mbr-text mbr-fonts-style display-7">Merci de choisir un mot de passe solide avec au moins 6
                    caractères.<br>Ne partagez avec personne vos identifiants de connexion afin de s'assurer qu'un tiers
                    n'accède à votre compte.</p>
            </div>
        </div>
    </div>
</section>

<section class="form cid-sK1JIDafy7" id="formbuilder-57">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto mbr-form">
                <!--Formbuilder Form-->
                <form action="{{ route('password.update') }}" method="POST" class="mbr-form form-with-styler"
                    data-form-title="Form Name">
                    @csrf
                    @method('post')
                    <div class="form-row">
                        <div hidden="hidden" data-form-alert="" class="alert alert-success col-12"></div>
                        @foreach ($errors->all() as $message)
                        <div data-form-alert-danger="" class="alert alert-danger col-12">{{$message}}</div>
                        @endforeach
                    </div>
                    <div class="dragArea form-row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4 class="mbr-fonts-style display-5">Choisir un nouveau mot de passe</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" style="">
                            <hr>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="token">
                            <input type="text" name="token" hidden="hidden" value="{{$token}}"
                                data-form-field="token" class="form-control display-7" required="required" value=""
                                id="token-formbuilder-57">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="email">
                            <label for="email-formbuilder-57"
                                class="form-control-label mbr-fonts-style display-7">
                                <strong>Email</strong></label>
                            <input type="email" name="email" placeholder="Votre adresse email"
                                data-form-field="email" class="form-control display-7" required="required" value=""
                                id="email-formbuilder-57">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="password">
                            <label for="password-formbuilder-57"
                                class="form-control-label mbr-fonts-style display-7"><strong>Mot de
                                    passe</strong></label>
                            <input type="password" name="password" placeholder="Nouveau mot de passe"
                                data-form-field="password" class="form-control display-7" required="required" value=""
                                id="password-formbuilder-57">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="password_confirmation">
                            <label for="password_confirmation-formbuilder-57"
                                class="form-control-label mbr-fonts-style display-7"><strong>Confirmation mot de
                                    passe</strong></label>
                            <input type="password" name="password_confirmation" placeholder="Confirmation"
                                data-form-field="password_confirmation" class="form-control display-7"
                                required="required" value="" id="password_confirmation-formbuilder-57">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary display-7">Valider</button>
                        </div>
                    </div>
                </form>
                <!--Formbuilder Form-->
            </div>
        </div>
    </div>
</section>
@endsection