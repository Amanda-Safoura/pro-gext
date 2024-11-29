@extends('site.layouts.auth')

@section('title', 'Enregistrer un nouveau mot de passe')

@section('page_content')

    <h2 class="text-center mb-4"><i class="fas fa-user-plus"></i> Réinitialisation du mot de passe</h2>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Saisissez votre email" required>
        </div>

        @error('email')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror

        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-sign-in-alt"></i>Envoyer le lien de
            réinitialisation</button>
    </form>
@endsection
