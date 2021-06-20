@extends('main')
@section('title', ' - Centres')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10">
            <form action="{{url('addcentre') }}" method="POST" class="form" role="form">
              <h3>Ajouter un nouveau centre</h3>
              <div class="col-lg-offset-2 col-lg-10 col-md-6 col-sm-12 centered">
              {{csrf_field()}}
              <div class="showback">
                  <br>
                  <input placeholder="Nom du centre" id="cen_name" type="text" class="form-control" name="cen_name" required>
                  <br>
                  <input placeholder="Numero du centre" id="cen_numero" type="text" class="form-control" name="cen_numero" required>
                  <br>
                  
                  <input placeholder="Téléphone" id="contact" type="text" class="form-control" name="contact" required>
                  <br>
                  <select name="vil_id" class="form-control centered">
                        <option value="">Choisir la ville</option>
                      @foreach ($villes as $ville)
                          <option value="{{ $ville->id }}">{{ $ville->vil_name }}</option>
                      @endforeach
                  </select>
                  <br>
                  <input class="btn btn-primary" value="Ajouter" type="submit"/>
              </div>
          </div>
          </form>
          <br>
          <h2>Liste des centres</h2>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered" id="prodtable">
            <thead>
               <tr>
                    <th>ID </th>
                  <th>Nom </th>
                  <th>numero</th>
                  <th>contact</th>
                  <th>ville</th>
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
                $('#prodtable').DataTable({
                serverSide: true,
                ajax: '{{ route('getcentre') }}',
                columns: [
                    { data: 'id', name: 'id','visible':false },
                    { data: 'cen_name', name: 'cen_name' },
                    { data: 'cen_numero', name: 'cen_numero' },
                    { data: 'contact', name: 'contact' },
                    { data: 'vil_name', name: 'vil_name' },
                    {data: 'action', name: 'action', orderable: false}
                      ],order: [[0, 'desc']]
             });
          });
    
    
    }
    </script>