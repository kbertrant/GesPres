@extends('main')

@section('title', ' - Modifier Personnel')

@section('main-content')
<div class="container col-lg-10 col-md-12 col-xs-12">
    
    <h2>Modifier un employé</h2>
    <br>
    <form  method="POST" action="{{ route('person.saveupdate') }}"> 
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $id }}">
        <input type="text" name="per_name" id="per_name" value="{{ $person->per_name }}"
                               class="form-control shadow"  required />
        <br/>       
        <input type="text" name="per_matricule" id="per_matricule" value="{{ $person->per_matricule }}"
                               class="form-control shadow" />
        <br/>
        <input type="text" name="per_poste" id="per_poste" value="{{ $person->per_poste }}"
        class="form-control shadow"  required />
        <br>
        <input placeholder="Date naissance" id="per_naiss" type="date" class="form-control shadow" name="per_naiss"
         value="{{ $person->per_naiss }}" required>
        <br>
        <input  id="per_classe" type="text" class="form-control shadow"  value="{{ $person->per_classe }}" name="per_classe" required>
        <br>
        <select id="is_personnel"name="is_personnel" class="form-control centered" required>
                <option value="">{{ $person->is_personnel }}</option>
                <option value="1">Agent Camrail</option>
                <option value="0">Famille</option>
          </select>
          <br>
        <select name="per_statut" class="form-control centered shadow">
            <option value="{{ $person->per_statut }}">{{ $person->per_statut }}</option>
            <option value="Eligible">Eligible</option>
            <option value="Non Eligible">Non Eligible</option>
        </select>
        <br>
        <select name="per_sexe" class="form-control centered shadow">
            <option value="{{ $person->per_sexe }}">{{ $person->per_sexe }}</option>
            <option value="H">H</option>
            <option value="F">F</option>
        </select>
        <br>
        <select name="pro_id" id="pro_id" class="form-control shadow" >
            <option value="">Choisir l'agent affilié</option>
            @foreach ($persons as $person)
            <option value="{{ $person->id }}">{{ $person->per_name }} </option>
            @endforeach
        </select>
         <br>
        <button type="submit" class="btn btn-success">Enregistrer</button>

    </form>
    <br>
</div>
@endsection
