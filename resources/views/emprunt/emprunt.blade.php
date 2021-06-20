@extends('main')

@section('title', ' - Emprunt Lunettes')

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
            <h2>Emprunt des lunettes</h2>
            <br>
            <form method="POST" action="{{ route('emprunt.save') }}"> 
                    @csrf
            <h5><b>{{ $centre }}</b></h5>
            <div class="row">
                <div class="col-lg-6">
                    <h5>Prescripteur : <b>{{ Auth::user()->name }}</b></h5>
                    <input type="text" name="num_emp" id="num_emp" placeholder="Numéro emprunt"
                        class="form-control shadow" required/>
                    <br/>  
                    <input type="text" name="per_id" id="per_id" placeholder="Nom du bénéficiaire"
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
    <h4 id="eligible"></h4>
        </div>
    </div>
    <br/>
    <button type="submit" id="getvalid" class="btn btn-success shadow">Enregistrer</button>
    </form>
    
    <h2>Liste des emprunts</h2>
    <br>
    <div class="table-responsive">
          <table class="table table-bordered" id="emptable">
              <thead>
                 <tr>
                      <th>ID </th>
                    <th>Nom patient </th>
                    <th>Médécin</th>
                    <th>Matricule</th>
                    <th>Centre</th>
                    <th>Numéro</th>
                    <th>Etat</th>
                    <th>Poste</th>
                    <th>Date emprunt</th>
                    <th>Date Echéance</th>
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
  
    
    
        var change_emp = $('#per_id');
        $(change_emp).change(function(){
            var id = change_emp.val();
            
            $.ajax({
                url: '/getinfos?id='+id,
                type: 'get',
                dataType: "json",
                success: function(response){
                    if(response.code === 200) {
                    console.log(response.message);
                    $('#per_name').text(response.per_name);
                    $('#per_matricule').text(response.per_matricule);
                    $('#per_naiss').text(response.per_naiss);
                    $('#per_sexe').text(response.per_sexe);
                    $('#eligible').text("Vous etes "+response.per_statut+" !");
                    }
                    if(response.per_statut == "Eligible"){
                        $('#getvalid').show();
                    }else{
                        $('#getvalid').hide();
                    }
                },
                error: function(error) {
                    console.log('error:' + JSON.stringify(error));
                }
            }); 
        });

      
    $(document).ready(function(){
                $('#emptable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('emprunt.get') }}',
                columns: [
                    { data: 'id', name: 'id','visible':false },
                    { data: 'per_name', name: 'per_name' },
                    { data: 'name', name: 'name' },
                    { data: 'per_matricule', name: 'per_matricule' },
                    { data: 'cen_name', name: 'cen_name' },
                    { data: 'num_emp', name: 'num_emp' },
                    { data: 'etat_emp', name: 'etat_emp' },
                    { data: 'per_poste', name: 'per_poste' },
                    { data: 'date_emp', name: 'date_emp' },
                    { data: 'date_fin', name: 'date_fin' },
                    {data: 'action', name: 'action', orderable: false}
                      ],order: [[0, 'desc']]
             });
          });
    
};
</script>