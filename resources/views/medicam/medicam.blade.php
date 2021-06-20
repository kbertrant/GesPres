@extends('main')
@section('title', ' - Médicaments')

@section('main-content')
<div class="container">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10">
            <form action="{{ route('medicam.save') }}" method="POST" class="form" role="form">
              <h3>Ajouter un médicament</h3>
              <div class="col-lg-offset-2 col-lg-10 col-md-6 col-sm-12 centered">
              {{csrf_field()}}
              <div class="showback">
                  <br>
                  <input placeholder="Nom du médicament" id="med_name" type="text" class="form-control" name="med_name" required>
                  <br>
                  <input placeholder="Prix (F CFA)" id="med_price" type="text" class="form-control" name="med_price" required>
                  <br>
                 
                  <input class="btn  btn-primary" value="Ajouter" type="submit"/>
              </div>
          </div>
          </form>
            <br>
            <h2>Liste des médicaments</h2>
      <br>
      <div class="table-responsive">
          <table class="table table-bordered" id="medicamtable">
              <thead>
                <tr>
                      <th>ID </th>
                    <th>Nom du médicament </th>
                    <th>Prix Unitaire (F CFA)</th>
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
              $('#medicamtable').DataTable({
              serverSide: true,
              ajax: '{{ route('medicam.get') }}',
              columns: [
                  { data: 'id', name: 'id','visible':false },
                  { data: 'med_name', name: 'med_name' },
                  { data: 'med_price', name: 'med_price' },
                  {data: 'action', name: 'action', orderable: false}
                    ],order: [[0, 'desc']]
           });
        });
  
  
  }
  </script>