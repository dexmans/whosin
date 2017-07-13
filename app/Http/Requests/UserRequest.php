<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $authUser = auth()->user();
        $user     = $this->user ?? new User;

        switch ($this->method()) {
            default:
                return $user->id == $authUser->id;
                break;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $authUser = auth()->user();

        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => [
                        'bail',
                        'required',
                        Rule::unique('users'),
                        'max:255',
                    ],
                    'email' => [
                        'bail',
                        'required',
                        'email',
                        Rule::unique('users'),
                        'max:255',
                    ],
                    'first_name' => [
                        'required',
                        'min:1',
                        'max:255',
                    ],
                    'last_name' => [
                        'required',
                        'min:1',
                        'max:255',
                    ],
                    'password' => [
                        'required',
                        'min:6',
                        'max:40',
                        'confirmed',
                    ],
                    'password_confirmation' => [
                        'required',
                        'min:6',
                        'max:40',
                    ],
                ];
                break;

            case 'PUT':
            case 'PATCH':
                return [
                    'name' => [
                        Rule::unique('users')->ignore($authUser->id),
                        'max:255',
                    ],
                    'email' => [
                        'email',
                        Rule::unique('users')->ignore($authUser->id),
                        'max:255',
                    ],
                    'first_name' => [
                        'min:1',
                        'max:255',
                    ],
                    'last_name' => [
                        'min:1',
                        'max:255',
                    ],
                    'password' => [
                        'min:6',
                        'max:40',
                        'confirmed',
                    ],
                    'password_confirmation' => [
                        'min:6',
                        'max:40',
                    ],
                ];
                break;

            default:
                return [];
                break;
        }
    }
}
