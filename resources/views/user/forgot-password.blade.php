@extends('base')

@section('title','Mot de passe oublié');

@section('description',"Formulaire de demande de réinitialisation du mot de passe")

@section('body')
<section data-bs-version="5.1" class="content6 cid-sK1Gjy95md" id="content6-50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <hr class="line">
                <p class="mbr-text align-center mbr-fonts-style my-4 display-5">
                    <em>Vous avez oublié votre mot de passe ?&nbsp;</em>Merci de renseigner votre adresse email afin de
                    recevoir un lien de réinitialisation.</p>
                <hr class="line">
            </div>
        </div>
    </div>
</section>

<section class="form cid-sK1Go4qWc0" id="formbuilder-51">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto mbr-form">
                <!--Formbuilder Form-->
                <form action="{{ route('password.email') }}" method="POST" class="mbr-form form-with-styler"
                    data-form-title="Form Name">
                    @method('post')
                    @csrf
                    <div class="form-row">
                        <div hidden="hidden" data-form-alert="" class="alert alert-success col-12"></div>
                        @foreach ($errors->all() as $message)
                        <div data-form-alert-danger="" class="alert alert-danger col-12">{{$message}}</div>
                        @endforeach
                    </div>
                    <div class="dragArea form-row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4 class="mbr-fonts-style display-5">Formulaire de réinitialisation</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div data-for="email" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <input required="required" type="email" name="email" placeholder="Email"
                                data-form-field="email" class="form-control display-7" value=""
                                id="email-formbuilder-51">
                        </div>
                        <div class="col"><button type="submit" class="btn btn-secondary display-7"><span
                                    class="mobi-mbri mobi-mbri-arrow-next mbr-iconfont mbr-iconfont-btn"></span>Continuer</button>
                        </div>
                    </div>
                </form>
                <!--Formbuilder Form-->
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="features19 cid-sK1HkALGyI" id="features20-53">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-9">
                <div class="card-wrapper pb-4">
                    <div class="card-box align-center">
                        <h4 class="card-title mbr-fonts-style mb-4 display-2">
                            <strong>Guide de réinitialisation</strong></h4>
                        <p class="mbr-text mbr-fonts-style mb-4 display-7"><strong>
                                Comment réinitialiser son mot de passe après l'avoir oublié ?</strong></p>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="item mbr-flex">
                    <div class="icon-box">
                        <span class="step-number mbr-fonts-style display-5">1</span>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title card-title mbr-black mbr-fonts-style display-7">
                            <strong>Renseigner le formulaire ci-dessus.</strong></h4>
                        <h5 class="icon-text mbr-black mbr-fonts-style display-4">Renseignez votre adresse email, vous
                            recevrez un lien de réinitialisation dans votre boite email que vous devriez consulter.</h5>
                    </div>
                </div>
                <div class="item mbr-flex">
                    <div class="icon-box">
                        <span class="step-number mbr-fonts-style display-5">2</span>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title card-title mbr-black mbr-fonts-style display-7">
                            <strong>Vérifier votre boite email</strong></h4>
                        <h5 class="icon-text mbr-black mbr-fonts-style display-4">Vérifiez le mail de réinitialisation
                            reçu, vous y trouverez un lien de réinitialisation sur lequel vous devrez cliquer pour
                            confirmer la validaté.</h5>
                    </div>
                </div>
                <div class="item mbr-flex last">
                    <div class="icon-box">
                        <span class="step-number mbr-fonts-style display-5">3</span>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title card-title mbr-black mbr-fonts-style display-7">
                            <strong>Changement de mot de passe</strong></h4>
                        <h5 class="icon-text mbr-black mbr-fonts-style display-4">Après avoir cliqué sur le lien, un
                            formulaire apparaitra en vous demandant de créer un nouveau mot de passe. Vous remplissez le
                            formulaire et vous validez. Et c'est fini !</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection