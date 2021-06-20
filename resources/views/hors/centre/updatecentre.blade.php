@extends('main')

@section('title', ' - Modifier Centre')

@section('main-content')
<div class="container col-lg-10 col-md-12 col-xs-12">
    
    <h2>Modifier un centre</h2>
    <br>
    <form  method="POST" action="{{ route('saveupdatecentre') }}"> 
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $id }}">
        <input type="text" name="cen_name" id="cen_name" value="{{ $centre->cen_name }}"
                               class="form-control shadow"  required />
        <br/>       
        <input type="text" name="cen_numero" id="cen_numero" value="{{ $centre->cen_numero }}"
                               class="form-control shadow"  required />
        <br/>
       
        <input type="text" name="contact" id="contact" value="{{ $centre->contact }}"
        class="form-control shadow"  required />
        <br/>
        <select name="vil_id" id="vil_id" class="form-control shadow" >
            <option value="">Choisir une ville </option>
            @foreach ($villes as $ville)
                <option value="{{ $ville->id }}">{{ $ville->vil_name }}</option>
            @endforeach
        </select>
        <br>
        <br>
        <button type="submit" class="btn btn-success">Enregistrer</button>

    </form>
    <br>
</div>
@endsection
