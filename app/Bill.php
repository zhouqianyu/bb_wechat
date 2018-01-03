<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bill';
    protected $fillable = ['user_id','total','type','code','remark'];
    public function books(){
        return $this->belongsToMany('App\Book','bill_book','bill_id','book_id')->withPivot('num');
    }
}
