<?php

namespace Modules\Categorias\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    protected $idcategoria = 'idcategoria';

    protected $table = 'categorias';
    public $translatedAttributes = [];
    protected $fillable = [

    
    'nombrecategoria'



    ];

}
