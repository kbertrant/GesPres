@extends('main')

@section('title', ' - Modifier ville')

@section('main-content')
<div class="container col-lg-10 col-md-12 col-xs-12">
    
    <h2>Modifier une ville</h2>
    <br>
    <form  method="POST" action="{{ route('saveupdateville') }}"> 
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $id }}">
        <input type="text" name="vil_name" id="vil_name" value="{{ $ville->vil_name }}"
                               class="form-control shadow"  required />
        <br/>       
        <input type="text" name="region" id="region" value="{{ $ville->region }}"
                               class="form-control shadow"  required />
        <br/>
        
        
        <br>
        <button type="submit" class="btn btn-success">Enregistrer</button>

    </form>
    <br>
</div>
@endsection
