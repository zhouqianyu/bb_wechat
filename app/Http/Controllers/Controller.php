<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function json_die($res)
    {
        die(json_encode($res, JSON_UNESCAPED_UNICODE));
    }
    function getOpenId($code){
        $appid = 'wx976e48b65711d7d1';
        $secret = 'a22f3fa2d3822723b46a0ad2f2ba5c63';
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx976e48b65711d7d1&secret=a22f3fa2d3822723b46a0ad2f2ba5c63&code=$code&grant_type=authorization_code";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($output, true);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $access_token = $res['access_token'];
        $open_id = $res['openid'];
        $refresh_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$open_id&lang=zh_CN";
        curl_setopt($ch, CURLOPT_URL, $refresh_url);
        $output = curl_exec($ch);
        $res2 = json_decode($output,true);
        if (isset($res2['headimgurl'])){
            User::updateOrCreate([
                'pic_url'=>$res2['headimgurl'],
                'user_id'=>$res2['openid']
            ],[
                'pic_url'=>$res2['headimgurl']
            ]);
        }
        return $res2['openid'];
    }
}
