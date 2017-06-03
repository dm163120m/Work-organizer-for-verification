<?php

class UserRepository {
    protected $model;

    public function __construct(User $model){
        $this->model = $model;
    }

    public function getAll(){
        return $this->model->all();
    }
}