@extends('main')

@section('title', ' - Attribuer le role')

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
            <h2>Nouvelle Attribution de role</h2>
            <br>
            <form method="POST" action="{{ route('saveroleuser') }}"> 
                    @csrf
            <select name="per_id" id="per_id" class="form-control shadow" required>
                <option value="">Choisir le prescripteur</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} </option>
                @endforeach
            </select>
            <br/>
            <select name="per_id" id="per_id" class="form-control shadow" required>
                    <option value="">Choisir le role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }} </option>
                    @endforeach
                </select>
        <br/>
                <button type="submit" class="btn btn-success shadow">Enregistrer</button>
            </form>
            <br>
            <h2>Liste des roles</h2>
      <br>
      <div class="table-responsive">
          <table class="table table-bordered" id="prodtable">
              <thead>
                 <tr>
                      <th>ID </th>
                    <th>Nom patient </th>
                    <th>role</th>
                    
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
                ajax: '{{ route('getroleuser') }}',
                columns: [
                    { data: 'id', name: 'id','visible':false },
                    { data: 'u_name', name: 'u_name' },
                    { data: 'r_name', name: 'r_name' },

                    {data: 'action', name: 'action', orderable: false}
                      ],order: [[0, 'desc']]
             });
          });
    
}
</script>