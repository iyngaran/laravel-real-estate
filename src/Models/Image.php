<?php


namespace Iyngaran\RealEstate\Models;


use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];
    protected $table = 'images';

    public function imageable()
    {
        return $this->morphTo();
    }

}