<?php

namespace NineCells\Til\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TilCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'writer_id',
    ];

    public function writer()
    {
        return $this->hasOne('App\User', 'id', 'writer_id');
    }

    public function posts()
    {
        return $this->hasMany('NineCells\Til\Models\TilPost', 'category_id');
    }
}
