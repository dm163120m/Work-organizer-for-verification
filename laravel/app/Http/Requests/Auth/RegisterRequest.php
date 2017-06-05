<?php
namespace App\Http\Requests\Auth;
use App\Http\Requests\Request;
class RegisterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|unique:users|max:20',
            'password' => 'required|min:6|max:20',
            'Name' => 'required|max:50',
            'Surname' => 'required|max:50',
            'email' => 'required|max:30|email',
            'imageUrl' => 'required|max:255',
            'role' => 'required|max:10',
        ];
    }
}