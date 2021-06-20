@extends('main')

@section('title', ' - Modifier Commande')


@section('main-content')
<div class="container col-lg-8">
    <h2>Ordonnance </h2>
        <br>
        <h3>Nom du patient : <b>{{ $ordonan[0]->per_name}}</b></h3>
        <h3>Matricule du patient : <b>{{ $ordonan[0]->per_matricule}}</b></h3>
        <h3>Genre du patient : <b>{{ $ordonan[0]->per_sexe}}</b></h3>
        <h3>Poste du patient : <b>{{ $ordonan[0]->per_poste}}</b></h3>
        <h3>Observations : <b>{{ $ordonan[0]->observations}}</b></h3>
        <h3>Prix total : <b>{{ $ordonan[0]->prix_total}} F CFA</b></h3>
        <br>
        <h2>Les médicaments prescrits</h2>
        
        <div class="row">
                <table class="table table-bordered">
                    <tr>
                        <th>Nom médicament</th>
                        <th>Quantité</th>
                        <th>Prix unitaire (en FCFA)</th>
                        <th>Total (enb FCFA)</th>
                    </tr>
                    @foreach($med_prescrits as $med_prescrit)
                    <tr>
                        <td>{{ $med_prescrit->med_name }}</td>
                        <td>{{ $med_prescrit->mp_qte }}</td>
                        <td>{{ $med_prescrit->med_price }}</td>
                        <td>{{  $med_prescrit->mp_qte*$med_prescrit->med_price }}</td>
                    </tr>
                    @endforeach
                </table>
        </div>
        <h3>Fait par : <b>Dr. {{ $ordonan[0]->name}}</b></h3>
</div>
@endsection
