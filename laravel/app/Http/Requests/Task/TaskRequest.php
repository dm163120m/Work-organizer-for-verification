<?php
/**
 * Milica Djordjevic 2016/3120
 */
namespace App\Http\Requests\Task;
use App\Http\Requests\Request;
class TaskRequest extends Request
{
    public function authorize()
    {
        return true;
    }
    public function rules(){
        return [
            'title' => 'required',
            'description' => 'required',
            'assignee' => 'required',
        ];
    }
}