<div class="modal mbr-popup cid-sIs2cxiwgM fade" tabindex="-1" role="dialog" data-overlay-color="#000000"
            data-overlay-opacity="0.8" id="mbr-popup-1f" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header pb-0">
                        <h5 class="modal-title mbr-fonts-style display-5">Se connecter</h5>
                        <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal"
                            aria-label="Close">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                viewBox="0 0 32 32" fill="currentColor">
                                <path
                                    d="M13.4 12l10.3 10.3-1.4 1.4L12 13.4 1.7 23.7.3 22.3 10.6 12 .3 1.7 1.7.3 12 10.6 22.3.3l1.4 1.4L13.4 12z">
                                </path>
                            </svg>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p class="mbr-text mbr-fonts-style display-7">
                            Saisissez vos identifiants de connexion puis cliquez sur "<strong>Se connecter</strong>".
                            Vous n'avez pas encore de compte ? <a ng-click="displayRegisterModal()"
                                class="text-primary"><strong><em>Ouvrir un compte ici</em></strong></a>.</p>

                        <div>
                            <div class="form-wrapper">
                                <!--Formbuilder Form-->
                                <form action="{{route('login')}}" method="POST" class="mbr-form form-with-styler"
                                    data-form-title="loginForm">
                                    @method('post')
                                    @csrf
                                    @foreach ($errors->all() as $message)
                                    <div data-form-alert-danger="" class="alert alert-danger col-12">
                                        {{$message}}
                                    </div>
                                    @endforeach
                                    <div class="dragArea">
                                        <div class="col form-group " data-for="email">
                                            <label for="email-mbr-popup-1f"
                                                class="form-control-label mbr-fonts-style display-7">Email</label>
                                            <input type="email" name="email" placeholder="Email" data-form-field="Email"
                                                required="required" class="form-control display-7" value=""
                                                id="email-mbr-popup-1f">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="password">
                                            <label for="password-mbr-popup-1f"
                                                class="form-control-label mbr-fonts-style display-7">Mot de
                                                passe</label>
                                            <input type="password" name="password" placeholder="Mot de passe"
                                                data-form-field="password" required="required"
                                                class="form-control display-7" value="" id="password-mbr-popup-1f">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="remember">
                                            <div class="form-control-label">
                                                <label for="remember-mbr-popup-1f" class="mbr-fonts-style display-7">Se
                                                    rappeler de moi</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="remember" data-form-field="remember"
                                                    class="form-check-input display-7" value="Oui" checked=""
                                                    id="remember-mbr-popup-1f-1">
                                                <label class="form-check-label display-7">Oui</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="remember" data-form-field="remember"
                                                    class="form-check-input display-7" value="Non"
                                                    id="remember-mbr-popup-1f-2">
                                                <label class="form-check-label display-7">Non</label>
                                            </div>
                                        </div>
                                        <div class="col-md-auto input-group-btn">
                                            <button type="submit" class="btn btn-primary display-4">Se
                                                connecter&nbsp;</button>
                                        </div>
                                    </div>
                                </form>
                                <!--Formbuilder Form-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>