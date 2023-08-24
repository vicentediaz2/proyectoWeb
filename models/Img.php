<?php
// example of using model with eloquent
namespace models;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    protected $table = 'img';
    protected $fillable = ['nombre','producto_id','relevancia'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
