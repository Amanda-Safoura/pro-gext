@extends('site.layouts.auth')

@section('title', 'Se connecter')

@section('page_content')

    <h2 class="text-center mb-4"><i class="fas fa-user-plus"></i> Connexion</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Saisissez votre email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"><i class="fas fa-lock"></i> Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Saisissez votre password" required>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember"><i class="fas fa-check"></i> Se rappeler de moi</label>

        </div>

        <div class="col-12">
            @error('general')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('password.request') }}" class="text-decoration-underline text-secondary">Mot de passe
                oublié?</a>
            <a href="{{ route('register') }}" class="text-secondary text-decoration-underline">Inscription</a>
        </div>

        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-sign-in-alt"></i> Se connecter</button>
    </form>
@endsection
