<?php
namespace App\Http\Requests\Test;
use App\Http\Requests\Request;
class TestRequest extends Request
{
    public function authorize()
    {
        return true;
    }
    public function rules(){
        return [
            'title' => 'required',
            'description' => 'required',
            'group_id' => 'required',
            'path' => 'required'
            ];
    }
}