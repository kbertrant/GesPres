@extends('main')

@section('title', ' - Modifier Personnel')

@section('main-content')
<div class="container col-lg-10 col-md-12 col-xs-12">
    
    <h2>Modifier un employé</h2>
    <br>
    <form  method="POST" action="{{ route('saveupdateperson') }}"> 
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $id }}">
        <input type="text" name="per_name" id="per_name" value="{{ $person->per_name }}"
                               class="form-control shadow"  required />
        <br/>       
        <input type="text" name="per_matricule" id="per_matricule" value="{{ $person->per_matricule }}"
                               class="form-control shadow"  required />
        <br/>
        <input type="text" name="per_poste" id="per_poste" value="{{ $person->per_poste }}"
        class="form-control shadow"  required />
        <br>
        <input placeholder="Date naissance" id="per_naiss" type="date" class="form-control" name="per_naiss"
         value="{{ $person->per_poste }}" required>
                  <br>
        <select name="per_sexe" class="form-control centered">
            <option value="{{ $person->per_sexe }}">{{ $person->per_sexe }}</option>
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
        </select>
        <br/>
        <button type="submit" class="btn btn-success">Enregistrer</button>

    </form>
    <br>
</div>
@endsection
