@extends('main')

@section('title', ' - Afficher Commande')


@section('main-content')
<div class="container col-lg-8">
    <div id="HTMLtoPDF">
    <h3>{{ $centre }}</h3>
    <br>
    <h5>Ordonnance N. {{ $ordonan[0]->num_ord}}</h5>
    <br>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-6">
            <span>Nom du patient : <b>{{ $ordonan[0]->per_name}}</b></span><br>
            <span>Poste : <b>{{ $ordonan[0]->per_poste}}</b></span><br>
            <span>Date naissance : <b>{{ $ordonan[0]->per_naiss}}</b></span><br>
            <span>Sexe : <b>{{ $ordonan[0]->per_sexe}}</b></span><br>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-6">
            <span>Date : <b>{{ $ordonan[0]->created_at}}</b></span><br>
            <span>Nom Agent : <b>{{ $agent_name }}</b></span><br>
            <span>Matricule : <b>{{ $agent_matricule}}</b></span><br>
            
            
        </div>
    </div>
        <br>
        <h4>Les médicaments prescrits</h4>
        <div class="row">
            <div class="table-responsive">
                <table id="ord" class="table table-striped">
                    <tr>
                        <th>Nom médicament</th>
                        <th>Quantité</th>
                        <th id="pu">P. U. (XAF)</th>
                        <th id="total">Total (XAF)</th>
                    </tr>
                    @foreach($med_prescrits as $med_prescrit)
                    <tr>
                        <td><b>{{ $med_prescrit->med_name }}</b> <br><b>Posologie :</b> {{ $med_prescrit->mp_posologie }}</td>
                        <td>{{ $med_prescrit->mp_qte }}</td>
                        <td>{{ round($med_prescrit->med_price,2) }}</td>
                        <td>{{ round($med_prescrit->mp_qte*$med_prescrit->med_price,2) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td><b>{{ round($ordonan[0]->prix_total,2)}}</b></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-4">
                Prescrit par : <b>Dr. {{ $ordonan[0]->name}}</b>
            </div>
            <div class="col-lg-6 col-md-4 col-xs-4">
                Le patient
            </div>
        </div>
        <br>
    </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-6">
                <button type="button" id="print" class="btn btn-danger shadow">Imprimer</button>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-6">
                <a href="{{ route('ordonan') }}" class="btn btn-warning shadow">Annuler</a>
            </div>
        </div>
        
</div>
@endsection
<script type="text/javascript">
    window.onload = function(){
        $('#print').click(function(){
            //$('#HTMLtoPDF').print();  
            var tbl = document.getElementById('ord');
            $("#total").hide()
            $("#pu").hide()
            $("td:nth-child(3)").hide()
            $("td:nth-child(4)").hide()
            
            var printContents = document.getElementById('HTMLtoPDF').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            $("td:nth-child(3)").show()
            $("td:nth-child(4)").show()
            $("#total").show()
            $("#pu").show()
        });
    }
</script>