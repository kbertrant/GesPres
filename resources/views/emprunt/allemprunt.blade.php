@extends('main')

@section('title', ' - Tous les emprunts')

@section('main-content')
<div class="container col-lg-10 col-md-12 col-xs-12">
    <div class="tab-content">
            <br>
            <h2>Toutes les lunettes prescrites</h2>
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
                    <th>Poste</th>
                    <th>Date emprunt</th>
                    <th>Date écheance</th>
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
                $('#emptable').DataTable({
                serverSide: true,
                ajax: '{{ route('emprunt.getall') }}',
                columns: [
                    { data: 'id', name: 'id','visible':false },
                    { data: 'per_name', name: 'per_name' },
                    { data: 'name', name: 'name' },
                    { data: 'per_matricule', name: 'per_matricule' },
                    { data: 'cen_name', name: 'cen_name' },
                    
                    { data: 'per_poste', name: 'per_poste' },
                    { data: 'date_emp', name: 'date_emp' },
                    { data: 'date_fin', name: 'date_fin' },
                    {data: 'action', name: 'action', orderable: false}
                      ],order: [[0, 'desc']]
             });
          });
    
}
</script>