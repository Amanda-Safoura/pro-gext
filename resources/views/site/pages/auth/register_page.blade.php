@extends('site.layouts.auth')

@section('title', 'S\'inscrire')

@section('page_content')

    <h2 class="text-center mb-4"><i class="fas fa-user-plus"></i> Inscription</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label"><i class="fas fa-user"></i>Username</label>
            <input type="text" name="name" id="name" class="form-control" data-error="Saisissez votre nom">
            @error('name')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label"><i class="fas fa-envelope"></i>Email</label>
            <input type="text" name="email" id="email" class="form-control" required
                data-error="Saisissez votre adresse mail">
            @error('email')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"><i class="fas fa-lock"></i>Mot de passe</label>
            <input class="form-control" type="password" name="password">
            @error('password')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label"><i class="fas fa-lock"></i>Confirmer votre mot de
                passe</label>
            <input class="form-control" type="password" name="password_confirmation">
            @error('password_confirmation')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p>
                Vous avez déjà un compte ?
                <a href="{{ route('login_page') }}" class="text-secondary text-decoration-underline">Connectez-vous</a>
            </p>

        </div>
        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-user-plus"></i>
            S'inscrire
        </button>
    </form>
@endsection
