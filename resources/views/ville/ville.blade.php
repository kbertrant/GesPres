@extends('main')
@section('title', ' - Villes')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10">
            <form action="{{ route('ville.save') }}" method="POST" class="form" role="form">
              <h3>Ajouter une nouvelle ville</h3>
              <div class="col-lg-offset-2 col-lg-10 col-md-6 col-sm-12 centered">
              {{csrf_field()}}
              <div class="showback">
                  <br>
                  <input placeholder="Nom de la ville" id="vil_name" type="text" class="form-control" name="vil_name" required>
                  <br>
                  <input placeholder="Nom de la region" id="region" type="text" class="form-control" name="region" required>
                  <br>
                  <input class="btn  btn-primary" value="Ajouter" type="submit"/>
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
  
  
  }
  </script>