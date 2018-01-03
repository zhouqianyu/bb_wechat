<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $fillable = ['user_id','point','pic_url'];
    public $timestamps = false;
    public function books(){
        return $this->belongsToMany('App\User','user_book','user_id','book_id');
    }
}
