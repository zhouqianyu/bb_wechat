<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillBook extends Model
{
    protected $table = 'bill_book';
    protected $fillable = ['bill_id','book_id','num'];

}
