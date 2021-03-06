@isset($shop)
<div class="modal mbr-popup cid-sITulK6G2k fade" ng-init="quantite=1" tabindex="-1" role="dialog"
    data-overlay-color="#000000" data-overlay-opacity="0.8" id="mbr-popup-34" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title mbr-fonts-style display-5">Acheter</h5>
                <button type="button" class="eclose" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
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
                    Vous allez ajouter "<a href="details-produit.html"
                        class="text-primary"><strong><em>@{{selectedProduct.nom}}</em></strong></a>" à votre panier.</p>
                <div>
                    <div class="form-wrapper">
                        <!--Formbuilder Form-->
                        <form action="{{ route('shop.panier.produit.save',compact('shop')) }}" method="POST"
                            class="mbr-form form-with-styler" data-form-title="addProductToCart" name="addToPanierForm">
                            @csrf
                            @method('post')
                            @foreach ($errors->all() as $message)
                            <div data-form-alert-danger="" class="alert alert-danger col-12">
                                {{ $message }}
                            </div>
                            @endforeach
                            <input hidden="hidden" ng-value="selectedProduct.id" ng-show="false" type="number"
                                name="produit_id" id="produit_id-mbr-popup-34">
                            <div class="dragArea">
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="quantite">
                                    <label for="quantite-mbr-popup-34"
                                        class="form-control-label mbr-fonts-style display-7">Saisir la quantité</label>
                                    <div class="input-group mb-3">
                                        <button ng-disabled="quantite<2" ng-click="quantite=quantite-1"
                                            class="btn btn-primary" type="button" id="button-addon1">-</button>
                                        <input style="width: auto;" type="number" name="quantite" placeholder="Quantité"
                                            ng-model="quantite" value="1" min="1" max="@{{selectedProduct.quantite}}"
                                            step="1" data-form-field="quantite" required="required"
                                            class="form-control display-7" value="" id="quantite-mbr-popup-34">
                                        <button ng-disabled="quantite>=selectedProduct.quantite"
                                            ng-click="quantite = quantite+1" class="btn btn-primary"
                                            type="button" id="button-addon2">+</button>
                                    </div>
                                </div>
                                <div class="col-12" ng-if="selectedProduct.quantite<20">
                                        <strong class="text-danger">@{{selectedProduct.quantite}} produit(s) disponible(s) en stock</strong>
                                </div>
                                <div class="col-md-auto input-group-btn">
                                    <button ng-disabled="addToPanierForm.$invalid" type="submit"
                                        class="btn btn-primary display-4 pull-right">
                                        <span
                                            class="mdi-toggle-check-box mbr-iconfont mbr-iconfont-btn"></span>VALIDER</button>
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
@endisset