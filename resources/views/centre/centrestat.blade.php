@extends('main')
@section('title', ' - Statistiques Centre')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10">
            <form action="{{ route('ville.save') }}" method="POST" class="form" role="form">
              <h3>Statistiques par centre</h3>
              <div class="col-lg-offset-2 col-lg-10 col-md-6 col-sm-12 centered">
              {{csrf_field()}}
              <div class="showback">
                  <br>
                  <select name="cen_id" class="form-control centered">
                    <option value="">Choisir le centre</option>
                  @foreach ($centres as $centre)
                      <option value="{{ $centre->id }}">{{ $centre->cen_name }}</option>
                  @endforeach
                </select>
                    <br>
                    <span>Date Début</span>
                  <input placeholder="Nom de la region" id="date_debut" type="date" class="form-control" name="region" required>
                  <br>
                  <span>Date Fin</span>
                  <input placeholder="Nom de la region" id="datefin" type="date" class="form-control" name="region" required>
                  <br>
                  <input class="btn  btn-primary" id="save"  value="Ajouter" type="button"/>
              </div>
          </div>
          </form>
            <br>
            <h2>Liste des villes</h2>
      <br>
      <div class="table-responsive">
          <table class="table table-bordered" id="villetable">
              <thead>
                <tr>
                      <th>ID </th>
                    <th>Ville </th>
                    <th>Region</th>
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
              $('#villetable').DataTable({
              serverSide: true,
              ajax: '{{ route('ville.get') }}',
              columns: [
                  { data: 'id', name: 'id','visible':false },
                  { data: 'vil_name', name: 'vil_name' },
                  { data: 'region', name: 'region' },
                  
                  {data: 'action', name: 'action', orderable: false}
                    ],order: [[0, 'desc']]
           });
        });
  
        var btn_save = $('#save');
        var cen_id = $('#cen_id');
        var date_debut = $('#date_debut');
        var date_fin = $('#date_fin');
        $(btn_save).click(function(){
            
            
            $.ajax({
                url: '/centre/getstat?cen_id='+cen_id+'&date_debut='+date_debut+'&date_fin='+date_fin,
                type: 'get',
                dataType: "json",
                success: function(response){
                    if(response.code === 200) {
                    console.log(response.cen_name);
                    
                    }
                },
                error: function(error) {
                    console.log('error:' + JSON.stringify(error));
                }
            }); 
        });
  }
  </script>