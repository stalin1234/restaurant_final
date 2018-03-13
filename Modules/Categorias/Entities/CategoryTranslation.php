<?php

namespace Modules\Categorias\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'categorias__category_translations';
}
