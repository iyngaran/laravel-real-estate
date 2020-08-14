<?php


namespace Iyngaran\RealEstate\Models;


use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];
    protected $table = 'contacts';

    public function owner()
    {
        return $this->morphTo();
    }
}