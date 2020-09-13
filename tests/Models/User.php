<?php


namespace Iyngaran\RealEstate\Tests\Models;

use Actuallymab\LaravelComment\CanComment;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use CanComment;

    protected $guarded = [];

    public $timestamps = false;

}