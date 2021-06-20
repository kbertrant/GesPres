@extends('main')

@section('title', ' - Utilisateur')

@section('main-content')
<div class="container col-lg-10 col-md-12 col-xs-12">
        
    <br>
    <h3>Modifier l'utilisateur</h3>
    <br>
    <form method="POST" enctype="multipart/form-data" action="{{ route('saveupdateuser') }}"> 
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
            
            <input type="file" name="image" id="image" placeholder="Votre photo"
                        class="form-control shadow"  required />
                    <br/>
                </div>
        <div class="col-md-6">

                <select name="genre" id="genre" class="form-control shadow"  required>
                        <option value="{{ $user->genre }}">{{ $user->genre }}</option>
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                    </select>
                        <br/>
                    <input type="phone" name="phone" id="phone" value="{{ $user->phone }}"
                                class="form-control shadow"  required />
                    <br/>
                    <input type="text" name="poste" id="poste" value="{{ $user->poste }}"
                                class="form-control shadow"  required />
                    <br/>
                    <select name="ville_name" id="ville_name" class="form-control shadow"  required>
                        <option value="{{ $user->ville_name }}">{{ $user->ville_name }}</option>
                        <option value="Douala">Douala</option>
                        <option value="Yaounde">Yaounde</option>
                        <option value="Edea">Edea</option>
                        <option value="Belabo">Belabo</option>
                        <option value="Mbitom">Mbitom</option>
                        <option value="Ngaoundere">Ngaoundere</option>
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
