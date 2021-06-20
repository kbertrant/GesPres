@extends('main')

@section('title', ' - Prescripteur')

@section('main-content')
<div class="container col-lg-10 col-md-12 col-xs-12">
        
    <br>
    <h3>Modifier le prescripteur</h3>
    <br>
    <form method="POST" enctype="multipart/form-data" action="{{ route('user.post') }}"> 
                    @csrf
    <div class="row">
        <div class="col-md-6">
            <input type="hidden" name="id" id="id" value="{{ $id }}">
            <input type="text" name="name" id="name" value="{{ $user->name }}"
                        class="form-control shadow"  required />
            <br/>
            <input type="email" name="email" id="email" value="{{ $user->email }}"
                        class="form-control shadow"  required />
            <br/>
            <input type="password" name="password" id="password" placeholder="Mot de passe"
                        class="form-control shadow" />
                    <br/>
            
            <input type="file" name="img" id="img"
                        class="form-control shadow"  required />
                    <br/>
                </div>
        <div class="col-md-6">

                <select name="genre" id="genre" class="form-control shadow"  required>
                        <option value="Femme" {{ ($user->genre == "Femme") ? 'selected' : '' }}>Femme </option>
                        <option value="Homme" {{ ($user->genre == "Homme") ? 'selected' : '' }}>Homme </option>
                    </select>
                        <br/>
                    <input type="phone" name="phone" id="phone" value="{{ $user->phone }}" placeholder="Ex: 697 662 979"
                                class="form-control shadow"  required />
                    <br/>
                    <input type="text" name="poste" id="poste" value="{{ $user->poste }}" placeholder="Poste"
                                class="form-control shadow"  required />
                    <br/>
                    <select name="cen_id" id="cen_id" class="form-control shadow"  required>
                        <option value="">Centre de service</option>
                        @foreach ($centres as $centre)
                            <option value="{{ $centre->id }}" {{ ($user->cen_id == $centre->id) ? 'selected' : '' }}>{{ $centre->cen_name }} </option>
                        @endforeach
                    </select>
                    <br/>
                    <select name="type_user" id="type_user" class="form-control shadow"  required>
                        <option value="">Type de prescripteur</option>
                        <option value="doctor">Doctor</option>
                        <option value="director">Director</option>
                        
                    </select>
                    <br/>
            
        </div>
    </div>
    
    <br>
    <button type="submit" class="btn btn-success shadow">Enregistrer</button>
    </form>
    <br>
    </div>
</div>
@endsection
