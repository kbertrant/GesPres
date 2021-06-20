@extends('main')

@section('title', ' - Profile')


@section('main-content')
<div class="container col-lg-10">
        <h2>Vos informations</h2>
        
            <div class="col-lg-12 col-md-10 mb-5">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-3">
                        <img src="/uploads/avatars/{{ Auth::user()->image }}" style="width:120px; height:120px;border-radius: 50%">
                        <br> 
                        <h5>{{ Auth::user()->name }}</h5>
                        <i>{{ Auth::user()->profession }}</i>
                    </div>
                    <div class="col-md-4">
                        Noms & Prénoms:<b> {{ Auth::user()->name }}</b><br>
                        Email:<b> {{ Auth::user()->email }}</b><br>
                        Sexe:<b> {{ Auth::user()->genre }}</b><br>  
                        Téléphone:<b> {{ Auth::user()->phone }}</b><br> 
                        
                           
                    </div>
                    <div class="col-md-4">
                        Poste :<b> {{ Auth::user()->poste }}</b><br> 
                          
                        Type de prescripteurs:<b> {{ Auth::user()->type_user }}</b><br>     
                        Date création :<b> {{ Auth::user()->created_at }}</b><br>       
                    </div>
                </div>
            </div>
            </div>
        </div>
        
    </div>
</div><br>        
    </div>
</div>
@endsection