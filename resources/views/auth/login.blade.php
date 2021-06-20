@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
            
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Connexion</h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                           
                            <div class="col-lg-12">
                                <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-user shadow" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            
                            <div class="col-lg-12">
                                <input id="password" type="password" placeholder="Mot de passe" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-user shadow" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" style="margin-top:10px">
                            <div class="col-lg-12 offset-lg-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        
                                    <label class="form-check-label" for="remember">
                                        {{ __('Se souvenir de moi') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group ">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary shadow">
                                    {{ __('Connexion') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            
        </div>
    </div>
</div>
@endsection
