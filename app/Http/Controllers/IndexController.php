<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Book;
use App\Cart;
use App\User;

class IndexController extends Controller
{
    public function index()
    {
        if (isset($_GET['code'])){
            $res = $this->getOpenId($_GET['code']);
            setcookie('userId',$res,time()+7200,'/');
            $_COOKIE['userId'] = $res;
        }
        if (User::where('user_id', $_COOKIE['userId'])->count() === 0)
            User::create([
                'user_id' => $_COOKIE['userId'],
                'point' => 0
            ]);
        $sheet = isset($_GET['sheet']) ? intval($_GET['sheet']) : 1;
        if ($sheet === 1) {
            $books = Book::limit(4)->get()->toArray();
            return view('index', ['data' => $books]);
        } elseif ($sheet === 2) {
            $type = isset($_GET['type']) ? intval($_GET['type']) : 1;
            $books = Book::where('type', $type)->get()->toArray();
            return view('sort', ['type' => $type, 'data' => $books]);
        } elseif ($sheet === 3) {
            $carts = Cart::where('user_id', $_COOKIE['userId'])->join('book', 'cart.book_id', '=', 'book.id')
                ->select('cart.id as cartId', 'book.name', 'book.pic_url', 'book.fee', 'cart.num')
                ->get()->toArray();
            $total = 0;
            foreach ($carts as $v) {
                $total += $v['fee'] * $v['num'];
            }
            return view('cart', ['total' => $total, 'data' => $carts]);
        } elseif ($sheet === 4) {
            $user = User::where('user_id', $_COOKIE['userId'])->first()->toArray();
            $waitPay = Bill::where('type', 1)->count();
            $waitSend = Bill::where('type', 2)->count();
            $waitReceive = Bill::where('type', 3)->count();
            $waitBack = Bill::where('type',4)->count();
            $collect = User::where('user_id', $_COOKIE['userId'])->first()->books()->count();
            return view('me', ['waitPay' => $waitPay, 'waitSend' => $waitSend, 'waitReceive' => $waitReceive, 'waitBack'=>$waitBack,'collect' => $collect, 'user' => $user]);
        }
    }

    public function detail()
    {
        $id = $_GET['id'];
        $book = Book::find($id)->toArray();
        return view('bookDetail', ['data' => $book]);
    }
    public function search(){
        $hint = $_GET['hint'];
        $books = Book::where('name','like',$hint.'%')->select('id','name')->get()->toArray();
        $this->json_die(['code'=>200,'msg'=>'success','data'=>$books]);
    }
    public function searchView()
    {
        return view('search');
    }
}
