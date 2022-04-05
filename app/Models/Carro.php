<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    protected $table = "carros";

    protected $fillable = [
        'nome',
        'marca',
        'cor',
        'lugares',
        'freio_abs',
        'velocidade_maxima'
    ];

    public function rules()
    {
    return[
            'nome'                      => 'required',
            'marca'                     => 'required',
            'cor'                       => 'required',
            'lugares'                   => 'required',
            'freio_abs'                 => 'required',
            'velocidade_maxima'         => 'required'
        ];
    }

    public function feedback()
    {
       return [
        'required'          => 'O campo :attribute não foi preenchido!'
        ];
    }

    use HasFactory;
}
