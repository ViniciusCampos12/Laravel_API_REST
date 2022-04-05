<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class CarroRepository{

    public function __construct(Model $model)
    {
        //injeta a model nos métodos

        $this->model = $model;
    }

    public function PegarId($id)
    {
        return  $this->model = $this->model->find($id);
    }

}
