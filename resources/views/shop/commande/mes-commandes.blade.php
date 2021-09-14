@extends('base')

@section('icon')
{{ asset('assets/images/produits-meta.jpeg') }}
@endsection

@section('title',"Mes commandes");

@section('description',"Mes commandes sur ".config('app.name'))

@section('body')
<section data-bs-version="5.1" class="header2 cid-sIYtuK6x6u" id="header02-3f">
    <div class="container">
        <div class="row">
            <div class="col-12">
                
            </div>
            <div class="col-12 col-md-12 col-lg-4 title-col">
                <h6 class="mbr-section-subtitle align-left mbr-fonts-style my-3 display-1"><strong>
                        {{ config('app.name') }}</strong></h6>
            </div>
            <div class="col-12 col-md-12 text-col col-lg-7">
                <p class="mbr-text align-left mbr-fonts-style mb-0 display-5"><strong>Retrouvez toutes les commandes passées sur la plateforme Katalog</strong><br></p>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="table1 marketm4_table1 cid-sIYEAqftSL" id="table1-3u">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-10">
				<div class="text-center text-lg-left">
					<h2 class="mbr-section-title mbr-bold mbr-fonts-style display-5">
						Mes commandes</h2>
				</div>
				<div class="row justify-content-between no-gutters">
                    <div class="col-lg-12 tables">
                        <div class="row justify-content-center no-gutters">
                            @foreach ($commandes as $commande)
                            <div class="col-sm-4 col-10 column" style="border: 1px solid lightgray;">
                                <a href="{{ route('shop.commande.show',['commande'=>$commande,'shop'=>$commande->shop]) }}">
                                    <div class="table__title text-center text-sm-left border__bot px-3">
                                        <h3 class="title mbr-medium mbr-fonts-style display-7">
                                            N° {{$commande->numero}}</h3>
                                    </div>
                                    <div class="cell text-center text-sm-left border__bot">
                                        <p class="mbr-fonts-style mbr-text display-4">
                                            Date: {{date_format($commande->created_at,'d M, Y à H:m:s')}}</p>
                                    </div>
                                    <div class="cell text-center text-sm-left border__bot">
                                        <p class="mbr-fonts-style mbr-text display-4">Boutique: {{$commande->shop->nom}}
                                        </p>
                                    </div>
                                    <div class="cell text-center text-sm-left border__bot">
                                        <p class="mbr-fonts-style mbr-text display-4 text-primary">
                                            <div style="padding: 5px; border: 2px solid #1a6c87;">
                                                Etat: <strong>{{ $commande->etat }}</strong>
                                            </div>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            @if(count($commandes)<1) <h3>Aucune commande pour le moment !</h3>
                                @endif
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</section>
@endsection