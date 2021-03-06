<?php
/**
 * Milica Djordjevic 2016/3120
 */
namespace App\Http\Requests\Auth;
use App\Http\Requests\Request;
class LoginRequest extends Request
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
            'username' => 'required',
            'password' => 'required|min:6',
        ];
    }
}