@extends('main')

@section('title', ' - Utilisateur')

@section('main-content')
<div class="container col-lg-10 col-md-12 col-xs-12">
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        <br>
    <h3>Ajouter un prescripteur</h3>
    <br>
    <form method="POST" enctype="multipart/form-data" action="{{ route('user.save') }}"> 
                    @csrf
    <div class="row">
        <div class="col-md-6">
            <input type="text" name="name" id="name" placeholder="Noms et prénoms"
                        class="form-control shadow"  required />
            <br/>
            <input type="email" name="email" id="email" placeholder="Adresse mail"
                        class="form-control shadow"  required />
            <br/>
            <input type="password" name="password" id="password" placeholder="Mot de passe"
                        class="form-control shadow"  required />
                    <br/>
            <input type="file" name="image" id="image" placeholder="Votre photo"
                        class="form-control shadow"  required />
                    <br/>
                </div>
        <div class="col-md-6">
            <select name="genre" id="genre" class="form-control shadow"  required>
                <option value="">Genre</option>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </select>
                <br/>
            <input type="phone" name="phone" id="phone" placeholder="(Ex: +237 697 662 979)"
                        class="form-control shadow"  required />
            <br/>
            <select name="cen_id" id="cen_id" class="form-control shadow"  required>
                <option value="">Centre de service</option>
                @foreach ($centres as $centre)
                    <option value="{{ $centre->id }}">{{ $centre->cen_name }} </option>
                @endforeach
            </select>
            <br/>
            <input type="text" name="poste" id="poste" placeholder="Poste occupé"
                        class="form-control shadow"  required />
            <br/>
            <select name="type_user" id="type_user" class="form-control shadow"  required>
                <option value="">Type de prescripteur</option>
                <option value="doctor">Doctor</option>
                <option value="director">Director</option>
                
            </select>
        </div>
    </div>
    <br>
    
    <button type="submit" class="btn btn-success shadow">Enregistrer</button>
    </form>
    <br>
    <h2>Liste des prescripteurs</h2>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered" id="usertable">
            <thead>
                <tr>
                    <th>ID </th>
                    <th>Noms Prénoms </th>
                    <th>email</th>
                    <th>photo</th>
                    <th>Téléphone</th>
                    <th>Genre</th>
                    <th>Centre</th>
                    <th>Type</th>
                    <th>Poste</th>
                    <th>Action</th>
                </tr>
            </thead>           
        </table>
    </div>
    </div>
</div>
@endsection
<script type="text/javascript">
    window.onload = function(){
    
        $(document).ready(function(){
                $('#usertable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('user.get') }}',
                columns: [
                    { data: 'id', name: 'id','visible':false },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'photo', name: 'photo' },
                    { data: 'phone', name: 'phone' },
                    { data: 'genre', name: 'genre' },
                    { data: 'cen_name', name: 'cen_name' },
                    { data: 'type_user', name: 'type_user' },
                    { data: 'poste', name: 'poste' },
                    {data: 'action', name: 'action', orderable: false}
                      ],order: [[0, 'desc']]
             });
          });
     
    }
    </script>