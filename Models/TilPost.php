<?php

namespace NineCells\Til\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TilPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'title', 'content', 'writer_id',
    ];

    public function getMdContentAttribute()
    {
        $content = $this->attributes['content'];
        $parsedown = new \Parsedown();
        return clean($parsedown->text($content));
    }

    public function writer()
    {
        return $this->hasOne('App\User', 'id', 'writer_id');
    }

    public function category()
    {
        return $this->belongsTo('NineCells\Til\Models\TilCategory', 'category_id');
    }
}
