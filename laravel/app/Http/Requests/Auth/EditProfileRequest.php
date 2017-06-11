<?php
/**
 * Milica Djordjevic 2016/3120
 */
namespace App\Http\Requests\Auth;
use App\Http\Requests\Request;
class EditProfileRequest extends Request{
    public function authorize(){
        return true;
    }
    public function rules(){
        return [
            'password' => 'required|min:6|max:20',
            'confirmPassword' => 'required|min:6|max:20',
            'email' => 'required|max:30|email',
            'imageUrl' => 'required|max:255',
        ];
    }
}