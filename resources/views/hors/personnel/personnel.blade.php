@extends('main')
@section('title', ' - Personnel')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10">
            <form action="{{ route('saveperson') }}" method="POST" class="form" role="form">
              <h3>Ajouter un nouvel empmloyé</h3>
              <div class="col-lg-offset-2 col-lg-10 col-md-6 col-sm-12 centered">
              {{csrf_field()}}
              <div class="showback">
                  <br>
                  <input placeholder="Noms et prénoms" id="per_name" type="text" class="form-control" name="per_name" required>
                  <br>
                  <input placeholder="Matricule" id="per_matricule" type="text" class="form-control" name="per_matricule" required>
                  <br>
                  <input placeholder="Poste occupé" id="per_poste" type="text" class="form-control" name="per_poste" required>
                  <br>
                  <input placeholder="Date naissance" id="per_naiss" type="date" class="form-control" name="per_naiss" required>
                  <br>
                  <select name="per_sexe" class="form-control centered">
                      <option value="">Choisir le genre</option>
                      <option value="Homme">Homme</option>
                      <option value="Femme">Femme</option>
                </select>
                <br>
                  <select id="is_personnel"name="is_personnel" class="form-control centered" required>
                      <option value="">Choisir le type d'assuré</option>
                      <option value="1">Agent Camrail</option>
                      <option value="0">Famille</option>
                </select>
                <br>
                <select name="pro_id" id="pro_id" class="form-control shadow" >
                  <option value="">Choisir l'agent affilié</option>
                  @foreach ($persons as $person)
                      <option value="{{ $person->id }}">{{ $person->per_name }} </option>
                  @endforeach
              </select>
                <br>
                  <input class="btn  btn-primary" value="Ajouter" type="submit"/>
              </div>
          </div>
          </form>
            <br>
            <h2>Liste des employés</h2>
      <br>
      <div class="table-responsive">
          <table class="table table-bordered" id="persontable">
              <thead>
                <tr>
                      <th>ID </th>
                    <th>Noms </th>
                    <th>Matricule</th>
                    <th>Poste</th>
                    <th>Sexe</th>
                    <th>Date naissance</th>
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
       $(document).ready(function(){
              $('#persontable').DataTable({
              serverSide: true,
              ajax: '{{ route('getperson') }}',
              columns: [
                  { data: 'id', name: 'id','visible':false },
                  { data: 'per_name', name: 'per_name' },
                  { data: 'per_matricule', name: 'per_matricule' },
                  { data: 'per_poste', name: 'per_poste' },
                  { data: 'per_sexe', name: 'per_sexe' },
                  { data: 'per_naiss', name: 'per_naiss' },
                  {data: 'action', name: 'action', orderable: false}
                    ],order: [[0, 'desc']]
           });
        });
  
        
        $(document).ready(function(){
            //$('#pro_id').hide();
            
            $('#is_personne').change(function(){
                var id = $("#is_personne option:selected").attr("value");
                if(id==1){
                    $('#pro_id').hide();
                  
                }else if(id==0){
                    $('#prod_id').show();
                    
                }else{
                    $('#prod_id').hide();
                }
                console.log(id);
            });
            
        });
  }
  </script>