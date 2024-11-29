@extends('site.layouts.auth')

@section('title', 'Enregistrer un nouveau mot de passe')

@section('page_content')

    <h2 class="text-center mb-4"><i class="fas fa-user-plus"></i> Modifier mon mot de passe</h2>
    <form method="POST" action="{{ route('password.update', ['token' => $token]) }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label for="email" class="form-label"><i class="fas fa-envelope"></i>Email</label>
            <input type="text" name="email" id="email" class="form-control" required data-error="Adresse mail">
            @error('email')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"><i class="fas fa-lock"></i>Mot de passe</label>
            <input class="form-control" type="password" name="password" placeholder="Veuillez saisir un mot de passe">
            @error('password')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label"><i class="fas fa-lock"></i>Confirmer votre mot de
                passe</label>
            <input class="form-control" type="password" name="password_confirmation"
                placeholder="Entrez le même mot de passe">
            @error('password_confirmation')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-user-plus"></i>
            Réinitialiser le mot de passe
        </button>
    </form>
@endsection
