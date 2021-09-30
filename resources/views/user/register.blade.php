<div ng-controller="UserController" class="modal mbr-popup cid-sIYpYiiWdO fade" tabindex="-1" role="dialog" data-overlay-color="#000000"
    data-overlay-opacity="0.8" id="mbr-popup-3a" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title mbr-fonts-style display-5">Formulaire de souscription pour les clients</h5>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"
                        fill="currentColor">
                        <path
                            d="M13.4 12l10.3 10.3-1.4 1.4L12 13.4 1.7 23.7.3 22.3 10.6 12 .3 1.7 1.7.3 12 10.6 22.3.3l1.4 1.4L13.4 12z">
                        </path>
                    </svg>
                </button>
            </div>

            <div class="modal-body">
                <p class="mbr-text mbr-fonts-style display-7">
                    Ayez votre compte afin de pouvoir shopper plus aisément.<br>Ouvrez un seul compte sur la plateforme
                    <strong>Katalog</strong> et connectez vous à des centaines de boutiques avec les mêmes identifiants.
                </p>

                <div>
                    <div class="form-wrapper">
                        <!--Formbuilder Form-->
                        <form ng-submit="register()" method="POST" class="mbr-form form-with-styler"
                            data-form-title="souscriptionForm" id="registerForm">
                            </div>
                            <div class="dragArea">
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="name">
                                    <label for="name-mbr-popup-3a"
                                        class="form-control-label mbr-fonts-style display-7">Nom complet</label>
                                    <input ng-model="userData.name" type="text" name="name" placeholder="Nom complet" data-form-field="name"
                                        required="required" class="form-control display-7" value=""
                                        id="name-mbr-popup-3a">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="telephone">
                                    <label for="telephone-mbr-popup-3a"
                                        class="form-control-label mbr-fonts-style display-7">Téléphone</label>
                                    <input ng-model="userData.telephone" type="tel" name="telephone" placeholder="Téléphone"
                                        data-form-field="telephone" required="required" class="form-control display-7"
                                        value="" id="telephone-mbr-popup-3a">
                                </div>
                                <div data-for="email" class="col-lg-12 col-md-12 col-sm-12 form-group" style="">
                                    <label for="email-mbr-popup-3a"
                                        class="form-control-label mbr-fonts-style display-7">Email</label>
                                    <input ng-model="userData.email" type="email" name="email" placeholder="test@email.com"
                                        data-form-field="email" class="form-control display-7" required="required"
                                        value="" id="email-mbr-popup-3a">
                                </div>
                                <div data-for="password" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="password-mbr-popup-3a"
                                        class="form-control-label mbr-fonts-style display-7">Nouveau mot de
                                        passe</label>
                                    <input ng-model="userData.password" type="password" name="password" placeholder="Nouveau mot de passe"
                                        data-form-field="password" class="form-control display-7" required="required"
                                        value="" id="password-mbr-popup-3a">
                                </div>
                                <div data-for="password_confirmation" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="password_confirmation-mbr-popup-3a"
                                        class="form-control-label mbr-fonts-style display-7">Confirmation mot de
                                        passe</label>
                                    <input ng-model="userData.password_confirmation" type="password" name="password_confirmation"
                                        placeholder="Confirmation mot de passe" data-form-field="password_confirmation"
                                        class="form-control display-7" required="required" value=""
                                        id="password_confirmation-mbr-popup-3a">
                                </div>
                                <div class="col input-group-btn">
                                    <button ng-disabled="registerForm.$invalid" type="submit"
                                        class="btn btn-primary display-4"><span
                                            class="mdi-content-create mbr-iconfont mbr-iconfont-btn"></span>S'inscrire&nbsp;</button>
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