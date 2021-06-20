@extends('main')

@section('title', ' - Afficher Emprunt lunettes')


@section('main-content')
<div class="container col-lg-8">
    <div id="HTMLtoPDF">
    <h4>{{ $emprunt[0]->cen_name }}</h4>
    <h5>Emprunt N. {{ $emprunt[0]->num_emp}}</h5>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <span>Nom du patient : <b>{{ $emprunt[0]->per_name}}</b></span><br>
            <span>Matricule : <b>{{ $emprunt[0]->per_matricule}}</b></span><br>
            <span>Date naissance : <b>{{ $emprunt[0]->per_naiss}}</b></span><br>
        </div>
        <div class="col-lg-6 col-md-6">
            <span>Date : <b>{{ $emprunt[0]->created_at}}</b></span><br>
            <span>Nom Agent : <b>{{ $agent_name }}</b></span><br>
            
            <span>Poste : <b>{{ $emprunt[0]->per_poste}}</b></span><br>
            
        </div>
    </div>
        <br>
        <h4>Les détails</h4>
        <div class="row">
                <div class="col-lg-6 col-md-6">
                        <span>Date Emprunt: <b>{{ $emprunt[0]->date_emp}}</b></span><br>
                        
                </div>
                <div class="col-lg-6 col-md-6">
                    
                        <span>Date échéance: <b>{{ $emprunt[0]->date_fin}}</b></span><br>
                </div>
        </div>
        <br>
        <h5>Prescrit par : <b>Dr. {{ $emprunt[0]->name}}</b></h5>
    </div>
        <div class="row">
            <div class="col-lg-6">
                <button type="button" id="print" class="btn btn-danger shadow">Imprimer</button>
            </div>
            <div class="col-lg-6">
                <a href="{{ route('ordonan') }}" class="btn btn-warning shadow">Annuler</a>
            </div>
        </div>
        
</div>
@endsection
<script type="text/javascript">
    window.onload = function(){
        $('#print').click(function(){
            $('#HTMLtoPDF').printThis({
                debug: true
            });
        });
    }
</script>