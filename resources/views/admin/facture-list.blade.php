@extends('base')

@section('title',"Liste des factures")

@section('description',"Liste des factures - vue admin");

@section('body')
<section style="margin-top: 45px;">

    <!-- Button trigger modal -->
    <a class="btn btn-primary display-4" data-toggle="modal" data-bs-toggle="modal" data-target="#mbr-popup-facture-new"
        data-bs-target="#mbr-popup-facture-new">
        Générer facture&nbsp;
    </a>

    <hr>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>N°</th>
                    <th>Titre</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Méthode Paiement</th>
                    <th>Date réglement</th>
                    <th>Client Phone</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($factures as $facture)
                <tr>
                    <td scope="row">{{ $loop->index+1 }}</td>
                    <td>{{ $facture->numero }}</td>
                    <td>{{ $facture->titre }}</td>
                    <td>{{ $facture->user->name }}</td>
                    <td>{{ $facture->montant }} FCFA</td>
                    <td>{{ $facture->methodePaiement }}</td>
                    <td>
                        @isset($facture->dateReglement)
                        {{ date_format($facture->dateReglement,'d/m/Y') }}
                        @endisset
                    </td>
                    <td>{{ $facture->clientPhone }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</section>

<div class="modal mbr-popup cid-sITulK6G2k fade" tabindex="-1" role="dialog" data-overlay-color="#000000"
    data-overlay-opacity="0.8" id="mbr-popup-facture-new" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title mbr-fonts-style display-5">Génération facture</h5>
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
                    Génération une facture qui doit être envoyé à l'utilisateur pour reglement.
                </p>
                <div>
                    <div class="form-wrapper">
                        <!--Formbuilder Form-->
                        <form action="{{ route('facture.store') }}" method="POST" class="mbr-form form-with-styler"
                            data-form-title="addProductToCart" name="addToPanierForm">
                            @csrf
                            @method('post')
                            @foreach ($errors->all() as $message)
                            <div data-form-alert-danger="" class="alert alert-danger col-12">
                                {{ $message }}
                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="user_id" class="form-label">Destinataire</label>
                                        <select required="required" class="form-control" name="user_id" id="user_id">
                                            <option value="">Selectionner le destinataire de la facture
                                            </option>
                                            @foreach ($users as $user)
                                            <option @if(old('user_id')==$user->id) selected @endif
                                                value="{{$user->id}}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="titre" class="form-label">Titre</label>
                                        <input value="{{old('titre')}}" required="required" type="text"
                                            class="form-control" name="titre" id="titre" aria-describedby="helpTitre"
                                            placeholder="Titre de la facture">
                                        <small id="helpTitre" class="form-text text-muted">Titre de la facture
                                            générée</small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="montant" class="form-label">Montant (FCFA)</label>
                                        <input value="{{old('montant')}}" required="required" type="number" min="0"
                                            class="form-control" name="montant" id="montant"
                                            aria-describedby="helpMontant" placeholder="Montant de la facture">
                                        <small id="helpMontant" class="form-text text-muted"></small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="delai" class="form-label">Délai de paiement</label>
                                        <input value="{{old('delai')}}" required="required" type="date"
                                            class="form-control" name="delai" id="delai" aria-describedby="delaiHelp"
                                            placeholder="Délai">
                                        <small id="delaiHelp" class="form-text text-muted">Date d'ici laquelle la
                                            facture doit être réglée</small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea required="required" class="form-control" name="description"
                                            id="description" rows="3"> {{old('description')}}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary pull-right">Générer</button>
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

@endsection