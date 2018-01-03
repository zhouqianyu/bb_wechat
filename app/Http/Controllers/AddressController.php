<?php

namespace App\Http\Controllers;

use App\Address;

class AddressController extends Controller
{
    public function choiceAddress(){
        $address = Address::where('user_id',$_COOKIE['userId'])->get()->toArray();
        return view('receiveAddressManage',['data'=>$address]);
    }
    public function add(){
        return view('addReceiveAddress');
    }
    public function addAddress(){
        $name = $_POST['name'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        $address = Address::create([
            'name'=>$name,
            'address'=>$address,
            'phone'=>$tel,
            'user_id'=>$_COOKIE['userId']
        ]);
        if ($address) $this->json_die(['code'=>200,'msg'=>'success']);
    }
    public function delete(){
        $id = $_POST['id'];
        $address = Address::find($id);
        if ($address&&$address->delete()) $this->json_die(['code'=>200,'msg'=>'success']);
    }
}
