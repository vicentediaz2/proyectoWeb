<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $fillable = ['nombre','decripcion','precio','stock','category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function usuarios()
    {
        return $this->belongsTo(Usuario::class);
    }
    public function img()
    {
        return$this->hasMany(Img::class);
    }
}

