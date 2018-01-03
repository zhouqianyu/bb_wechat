<?php

namespace App\Http\Controllers;

use App\Address;
use App\Bill;
use App\Book;
use App\Cart;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BillController extends Controller
{
    public function waitPay(){
        $id = $_GET['id'];
        $user = User::where('user_id',$_COOKIE['userId'])->first();
        $bill = Bill::with('books')->find($id)->toArray();
        if (!isset($_GET['address_id'])) {
            $address = Address::where('user_id', $_COOKIE['userId'])->first();
            if ($address) $address=$address->toArray();
        }
        else $address = Address::find($_GET['address_id'])->toArray();
        $amount = 0;
            foreach ($bill['books'] as $book) {
                $amount += intval($book['pivot']['num']);
            }
            $bill['amount'] = $amount;
        return view('balance',['data'=>$bill,'point'=>$user->point,'amount'=>$amount,'address'=>$address]);
    }
    public function toPay()
    {
        $ids = $_POST['ids'];
        $ids = json_decode($ids,true);
        $carts = Cart::whereIn('cart.id', $ids)->join('book', 'cart.book_id', '=', 'book.id')->select('book.id as bookId', 'fee', 'num')->get()->toArray();
        $bookIds = Cart::whereIn('id',$ids)->pluck('book_id')->toArray();
        DB::beginTransaction();
        try {
            Book::whereIn('id', $bookIds)->update(['sale_num' => DB::raw('sale_num + 1'), 'remain' => DB::raw('remain - 1')]);
            $total = 0;
            foreach ($carts as $k => $v) {
                $total += $v['num'] * $v['fee'];
                unset($carts[$k]['fee']);
            }
            Cart::whereIn('id',$ids)->delete();
            $bill = Bill::create([
                'user_id' => $_COOKIE['userId'],
                'total' => $total,
                'type' => 1,
                'code' => Str::random(13)
            ]);
            $books = array();
            foreach ($carts as $k => $v) {
                $books[$v['bookId']] = ['num' => $v['num']];
            }
            $bill->books()->attach($books);
            DB::commit();
            $this->json_die(['code' => 200, 'msg' => 'success', 'data' => $bill->id]);
        }catch (\Exception $e){
            DB::rollBack();
            print_r($e->getMessage());
            exit();
        }
    }

    public function pay()
    {
        $id = $_POST['id'];
        DB::beginTransaction();
        try {
            $bill = Bill::find($id);
            $bill->type=2;
            $bill->save();
            $user = User::where('user_id', $_COOKIE['userId'])->first();
            $user->point += $bill->total / 10;
            $user->save();
            DB::commit();
        } catch (\Exception $e) {
            print_r($e->getMessage());
            DB::rollBack();
        }
    }

    public function bill()
    {
        $sheet = isset($_GET['sheet']) ? intval($_GET['sheet']) : 1;
        if ($sheet === 1) {
            $bill = Bill::where('type', 1)->with('books')->orderBy('created_at')->get()->toArray();
            foreach ($bill as $k => $v) {
                $amount = 0;
                foreach ($v['books'] as $book) {
                    $amount += intval($book['pivot']['num']);
                }
                $bill[$k]['amount'] = $amount;
            }
            return view('waitPay', ['data' => $bill]);
        } elseif ($sheet === 2) {
            $bill = Bill::where('type', 2)->with('books')->orderBy('created_at')->get()->toArray();
            foreach ($bill as $k => $v) {
                $amount = 0;
                foreach ($v['books'] as $book) {
                    $amount += intval($book['pivot']['num']);
                }
                $bill[$k]['amount'] = $amount;
            }
            return view('waitSend', ['data' => $bill]);
        } elseif ($sheet === 3) {
            $bill = Bill::where('type', 3)->with('books')->orderBy('created_at')->get()->toArray();
            foreach ($bill as $k => $v) {
                $amount = 0;
                foreach ($v['books'] as $book) {
                    $amount += intval($book['pivot']['num']);
                }
                $bill[$k]['amount'] = $amount;
            }
            return view('waitReceive', ['data' => $bill]);
        }
        elseif ($sheet === 4) {
            $bill = Bill::where('type', 4)->with('books')->orderBy('created_at')->get()->toArray();
            foreach ($bill as $k => $v) {
                $amount = 0;
                foreach ($v['books'] as $book) {
                    $amount += intval($book['pivot']['num']);
                }
                $bill[$k]['amount'] = $amount;
            }
            return view('waitBack', ['data' => $bill]);
        }
        elseif ($sheet === 0) {
            $bill = Bill::with('books')->orderBy('created_at')->get()->toArray();
            foreach ($bill as $k => $v) {
                $amount = 0;
                foreach ($v['books'] as $book) {
                    $amount += intval($book['pivot']['num']);
                }
                $bill[$k]['amount'] = $amount;
            }
            return view('allOrder', ['data' => $bill]);
        }
    }
    public function confirm(){
        $id = $_POST['id'];
        $bill = Bill::find($id);
        $bill->type = 3;
        $bill->save();
        $this->json_die(['code'=>200,'msg'=>'success']);
    }

    public function back(){
        $id = $_POST['id'];
        $bill = Bill::find($id);
        $bill->type = 4;
        $bill->save();
        $this->json_die(['code'=>200,'msg'=>'success']);
    }
    public function cancel(){
        $id = $_GET['id'];
        $bill = Bill::find($id);
        $bill->type = 5;
        $bill->save();
        $this->json_die(['code'=>200,'msg'=>'success']);
    }
}
