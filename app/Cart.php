<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $fillable = ['user_id','book_id','num'];
    public $timestamps = false;
}
