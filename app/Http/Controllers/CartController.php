<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add()
    {
        $bookId = $_POST['bookId'];
        Cart::updateOrCreate([
            'user_id' => $_COOKIE['userId'],
            'book_id' => $bookId,

        ], [
            'num' => DB::raw('num + 1')
        ]);
        $this->json_die(['code'=>200]);
    }
    public function delete(){
        $bookIds = json_decode($_POST['ids'],true);
        $carts = Cart::whereIn('id',$bookIds)->delete();
        if ($carts) $this->json_die(['code'=>200,'msg'=>'success']);
    }
}
