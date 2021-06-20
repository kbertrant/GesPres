@extends('main')

@section('title', ' - Modifier médicament')

@section('main-content')
<div class="container col-lg-10 col-md-12 col-xs-12">
    
    <h2>Modifier un médicament</h2>
    <br>
    <form  method="POST" action="{{ route('saveupdatemedicam') }}"> 
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $id }}">
        <input type="text" name="med_name" id="med_name" value="{{ $medicam->med_name }}"
                               class="form-control shadow"  required />
        <br/>       
        <input type="text" name="med_price" id="med_price" value="{{ $medicam->med_price }}"
                               class="form-control shadow"  required />
        <br/>
        
        <button type="submit" class="btn btn-success">Enregistrer</button>

    </form>
    <br>
</div>
@endsection
