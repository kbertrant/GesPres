@extends('main')
@section('title', ' - Médécins')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10">
            <br>
            <h2>Liste des médécins</h2>
      <br>
      <div class="table-responsive">
          <table class="table table-bordered" id="persontable">
              <thead>
                <tr>
                      <th>ID </th>
                    <th>Noms </th>
                    <th>email</th>
                    <th>Phones</th>
                    <th>Genre</th>
                    <th>type</th>
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
              ajax: '{{ route('getmedecin') }}',
              columns: [
                  { data: 'id', name: 'id','visible':false },
                  { data: 'name', name: 'name' },
                  { data: 'email', name: 'email' },
                  { data: 'phone', name: 'phone' },
                  { data: 'genre', name: 'genre' },
                  { data: 'type_user', name: 'type_user' },
                  {data: 'action', name: 'action', orderable: false}
                    ],order: [[0, 'desc']]
           });
        });
  
  
  }
  </script>