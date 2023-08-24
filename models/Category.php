<?php
// example of using model with eloquent
namespace models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'category';
    protected $fillable = ['nombre'];

    public function producto()
    {
        return$this->hasMany(Producto::class);
    }
}
  