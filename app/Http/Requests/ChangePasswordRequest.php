<?php

namespace App\Http\Requests;

use App\Http\Controllers\Auth\AuthController;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->input('origin') && is_string($this->input('origin'))) {

            $origin = AuthController::getTokenEmail($this->input('origin'));

            if (User::whereEmail($origin)->firstOrFail())
                return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'origin' => 'bail|required|string',
            'password' => 'bail|required|confirmed|string|min:8|max:40',
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            // Origin
            'origin.required' => 'L\'origine est obligatoire.',
            'origin.string' => 'L\'origine doit être une chaîne de caractères.',

            // Mot de passe
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.string' => 'Le mot de passe doit être une chaîne de caractères.',
            'password.min' => 'Le mot de passe doit comporter au moins 8 caractères.',
            'password.max' => 'Le mot de passe ne doit pas dépasser 40 caractères.',

            // Confirmation du mot de passe
            'password_confirmation.required' => 'La confirmation du mot de passe est obligatoire.',
        ];
    }
}
