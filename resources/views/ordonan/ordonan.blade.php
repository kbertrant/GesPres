@extends('main')

@section('title', ' - Ordonnance')

@section('main-content')
<div class="container col-lg-10 col-md-12 col-xs-12">
    <div class="tab-content">
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="tab-pane fade show active " id="p1">
                <br>
            <h2>Nouvelle ordonnance</h2>
            <br>
            <form method="POST" action="{{ route('ordonan.save') }}"> 
                    @csrf
            <h5><b>{{ $centre }}</b></h5>
            <div class="row">
                <div class="col-lg-6">
                    <h5>Prescripteur : <b>{{ Auth::user()->name }}</b></h5>
                    <input type="text" name="num_ord" id="num_ord" placeholder="Numéro ordonnance"
                        class="form-control shadow" required/>
                    <br/>  
                    <input type="text" name="per_id" id="per_id" placeholder="Nom patient"
                        class="form-control shadow typeahead " required/>
                    <br/>     
                    
                </div>
                <div class="col-lg-6">
                    <h6>Date : <b>{{ date('d-m-y') }}</b></h6> 
                    <h6>Date naissance : <b id="per_naiss"></b></h6>
                    <h6>Sexe : <b id="per_sexe"></b></h6>
                    <span>Agent responsable</span>
                    <h6>Nom Agent : <b id="per_name"></b></h6>
                    <h6>Matricule : <b id="per_matricule"></b></h6>
                    
            </div>
            </div>
            
           
            <br/>
            
            
            <h3>Les médicaments prescrits</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-xs-3">
                    Nouveau médicament : 
                </div>
                <div class="col-lg-2 col-md-2 col-xs-2">
                    <a href="javascript:void(0);" class="add_buttonEN" title="Ajouter">
                    <img src="{{ asset('img/add-icon.png') }}"/></a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 col-md-7 col-xs-7" style="padding:10px">
                    <select name="med_id[]" id="med_id[]" class="form-control shadow" required>
                        <option value="">Choisir le médicament</option>
                        @foreach ($medicams as $medicam)
                            <option value="{{ $medicam->id }}">{{ $medicam->med_name }} - {{ $medicam->med_price }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-3" style="padding:10px">
                        <select name="mp_condition[]" id="mp_condition[]" class="form-control qte shadow">
                            <option value="">Détail ou boite ?</option>
                            <option value="Detail">Détail</option>
                            <option value="Boite">Boite</option>
                        </select>        
                    </div>
                <div class="col-lg-2 col-md-2 col-xs-2" style="padding:10px">
                Posologie :        
                </div>
                <div class="col-lg-2 col-md-2 col-xs-2">
                    <select name="mp_prise[]" id="mp_prise[]" class="form-control qte shadow">
                        <option value="">Prises</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>        
                </div>
                <div class="col-lg-2 col-md-2 col-xs-2">
                        <select name="mp_type[]" id="mp_type[]" class="form-control qte shadow">
                            <option value="">Types</option>
                            <option value="comprimé(s)">Comprimé(s)</option>
                            <option value="gellule(s)">Gellule(s)</option>
                            <option value="injection(s)">Injection(s)</option>
                            <option value="cuillère(s)">Cuillère(s)</option>
                            <option value="ampoule(s)">Ampoule(s)</option>
                            <option value="sachet(s)">Sachet(s)</option>
                            <option value="soluté(s)">Solutés(s)</option>
                            <option value="bain(s) de bouche">Bain(s) de bouche</option>
                            <option value="application(s)">Application(s)</option>
                        </select>        
                    </div>
                    <div class="col-lg-2 col-md-2 col-xs-2">
                            <select name="mp_fois[]" id="mp_fois[]" class="form-control qte shadow">
                                <option value="">Fois</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>        
                        </div>
                    <div class="col-lg-2 col-md-2 col-xs-2">
                        <select name="mp_jour[]" id="mp_jour[]" class="form-control qte shadow">
                            <option value="">Jour</option>
                            <option value="par Jour">par Jour</option>
                            <option value="après 1 jour">après 1 jour</option>
                            <option value="Après 2 jours">Après 2 jours</option>
                            <option value="Après 3 jours">Après 3 jours</option>
                            <option value="Après 5 jours">Après 5 jours</option>
                            <option value="Après 7 jours">Après une semaine</option>
                            <option value="Après 10 jours">Après 10 jours</option>
                            <option value="Après 14 jours">Après 2 semaines</option>
                        </select>        
                    </div>
                    <div class="col-lg-2 col-md-2 col-xs-2">
                            <select name="mp_periode[]" id="mp_periode[]" class="form-control qte shadow">
                                <option value="">Periode</option>
                                <option value="Matin / Soir">Matin / Soir</option>
                                <option value="Matin / Midi / Soir">Matin / Midi / Soir</option>
                                <option value="Tous les matins">Tous les matins</option>
                                <option value="Tous les soirs">Tous les soirs </option>
                                
                            </select>        
                        </div>
            <div class="col-lg-2 col-md-2 col-xs-2">
                <select name="mp_duree[]" id="mp_duree[]" class="form-control qte shadow">
                    <option value="">Durée</option>
                    <option value="1">1 jour</option>
                    <option value="2">2 jours</option>
                    <option value="3">3 jours</option>
                    <option value="4">4 jours</option>
                    <option value="5">5 jours</option>
                    <option value="7">7 jours</option>
                    <option value="10">10 jours</option>
                    <option value="14">14 jours</option>
                    <option value="21">21 jours</option>
                    <option value="30">30 jours</option>
                </select>        
            </div>
            
        </div>
        <br/>
        <div class="field_wrapperEN"><div>
            
        </div>
        </div>
        <br/>
                <button type="submit" class="btn btn-success shadow">Enregistrer</button>
            </form>
            <br>
            <h2>Liste des ordonnances prescrites</h2>
      <br>
      <div class="table-responsive">
          <table class="table table-bordered" id="prodtable">
              <thead>
                 <tr>
                      <th>ID </th>
                    <th>Nom patient </th>
                    <th>Médécin</th>
                    <th>Matricule</th>
                    <th>Centre</th>
                    <th>Prix</th>
                    <th>Poste</th>
                    <th>Date</th>
                    <th>Action</th>
                 </tr>
              </thead>
      </table>
      </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
window.onload = function(){
    var route = "{{ url('autoperson') }}";
    $('#per_id').typeahead({
        type: 'POST',
        dataType: 'JSON',
        source:  function (term, process) {
        return $.get(route, { term: term }, function (data) {
            console.log(data);
                return process(data);
            });
        }
    });
  
    //add for entrées
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_buttonEN'); //Add button selector
        var wrapper = $('.field_wrapperEN'); //Input field wrapper
        var fieldHTML = '<div class="row" style="margin:15px">'
        +'<a href="javascript:void(0);" class="remove_buttonEN">'
        +'<img src="{{ asset('img/remove-icon.png') }}"/>'
        +'</a>'
            
        +'<div class="col-lg-6 col-md-6 col-xs-6" style="padding:10px">'
        +'<select name="med_id[]" id="med_id[]" class="form-control shadow" required>'
        +'<option value="">Choisir le médicament</option>'
        +'@foreach ($medicams as $medicam)'
        +'<option value="{{ $medicam->id }}">{{ $medicam->med_name }} - {{ $medicam->med_price }}</option>'
        +'@endforeach'
        +'</select>'
        +'</div>'
        +'<div class="col-lg-3 col-md-3 col-xs-3" style="padding:10px">'
        +'<select name="mp_condition[]" id="mp_condition[]" class="form-control qte shadow">'
        +'<option value="">Détail ou boite ?</option>'
        +'<option value="Detail">Détail</option>'
        +'<option value="Boite">Boite</option>'
        +'</select>'
        +'</div>'
        +'<div class="col-lg-2 col-md-2 col-xs-2" style="padding:10px">Posologie :  '      
        +'</div>'
        +'<div class="col-lg-2 col-md-2 col-xs-2">'
        +'<select name="mp_prise[]" id="mp_prise[]" class="form-control qte shadow">'
        +'<option value="">Prises</option>'
        +'<option value="1">1</option>'
        +'<option value="2">2</option>'
        +'<option value="3">3</option>'
        +'<option value="4">4</option>'
        +'<option value="5">5</option>'
        +'</select>        '
        +'</div>'
        +'<div class="col-lg-2 col-md-2 col-xs-2">'
        +'<select name="mp_type[]" id="mp_type[]" class="form-control qte shadow">'
        +'<option value="">Types</option>'
        +'<option value="Comprimé(s)">Comprimé(s)</option>'
        +'<option value="Gellule(s)">Gellule(s)</option>'
        +'<option value="Injection(s)">Injection(s)</option>'
        +'<option value="Cuillère(s)">Cuillère(s)</option>'
        +'<option value="Ampoule(s)">Ampoule(s)</option>'
        +'<option value="Sachet(s)">Sachet(s)</option>'
        +'<option value="soluté(s)">Solutés(s)</option>'
        +'<option value="bain(s) de bouche">Bain(s) de bouche</option>'
        +'<option value="application(s)">Application(s)</option>'
        +'</select>'        
        +'</div>'
        +'<div class="col-lg-2 col-md-2 col-xs-2">'
        +'<select name="mp_fois[]" id="mp_fois[]" class="form-control qte shadow">'
        +'<option value="">Fois</option>'
        +'<option value="1">1</option>'
        +'<option value="2">2</option>'
        +'<option value="3">3</option>'
        +'<option value="4">4</option>'
        +'<option value="5">5</option>'
        +'</select>'
        +'</div>'
        +'<div class="col-lg-2 col-md-2 col-xs-2">'
        +'<select name="mp_jour[]" id="mp_jour[]" class="form-control qte shadow">'
        +'<option value="">Jour</option>'
        +'<option value="par Jour">par Jour</option>'
        +'<option value="après 1 jour">après 1 jour</option>'
        +'<option value="Après 2 jours">Après 2 jours</option>'
        +'<option value="Après 3 jours">Après 3 jours</option>'
        +'<option value="Après 5 jours">Après 5 jours</option>'
        +'<option value="Après 7 jours">Après une semaine</option>'
        +'</select>'        
        +'</div>'
        +'<div class="col-lg-2 col-md-2 col-xs-2">'
        +'<select name="mp_periode[]" id="mp_periode[]" class="form-control qte shadow">'
        +'<option value="">Periode</option>'
        +'<option value="Matin / Soir">Matin / Soir</option>'
        +'<option value="Matin / Midi / Soir">Matin / Midi / Soir</option>'
        +'<option value="Tous les matins">Tous les matins</option>'
        +'<option value="Tous les soirs">Tous les soirs </option>'                      
        +'</select>'        
        +'</div>'
        +'<div class="col-lg-2 col-md-2 col-xs-2">'
        +'<select name="mp_duree[]" id="mp_duree[]" class="form-control qte shadow">'
        +'<option value="">Durée</option>'
        +'<option value="1">1 jour</option>'
        +'<option value="2">2 jours</option>'
        +'<option value="3">3 jours</option>'
        +'<option value="4">4 jours</option>'
        +'<option value="5">5 jours</option>'
        +'<option value="7">7 jours</option>'
        +'<option value="10">10 jours</option>'
        +'</select>'        
        +'</div>'
        
        +'</div>';

        //Once add button is clicked
        


        var x = 1; //Initial field counter is 1
        
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_buttonEN', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    $(document).ready(function(){
                $('#prodtable').DataTable({
                serverSide: true,
                ajax: '{{ route('ordonan.get') }}',
                columns: [
                    { data: 'id', name: 'id','visible':false },
                    { data: 'per_name', name: 'per_name' },
                    { data: 'name', name: 'name' },
                    { data: 'per_matricule', name: 'per_matricule' },
                    { data: 'cen_name', name: 'cen_name' },
                    { data: 'prix_total', name: 'prix_total' },
                    { data: 'per_poste', name: 'per_poste' },
                    { data: 'created_at', name: 'created_at' },
                    {data: 'action', name: 'action', orderable: false}
                      ],order: [[0, 'desc']]
             });
          });

          var change_emp = $('#per_id');
        $(change_emp).change(function(){
            var id = change_emp.val();
            $.ajax({
                url: '/getinfos?id='+id,
                type: 'get',
                dataType: "json",
                success: function(response){
                    if(response.code === 200) {
                    console.log("Voici ce qui s'affiche !!!!!"+response.message);
                    $('#per_name').text(response.per_name);
                    $('#per_matricule').text(response.per_matricule);
                    $('#per_naiss').text(response.per_naiss);
                    $('#per_sexe').text(response.per_sexe);
                    $('#eligible').text("Vous etes "+response.per_statut+" !");
                    }
                },
                error: function(error) {
                    console.log('error:' + JSON.stringify(error));
                }
            }); 
        });
    
};
</script>