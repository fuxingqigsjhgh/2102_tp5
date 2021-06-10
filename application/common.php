<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function sendSms($phone,$code){
    $host = "http://dingxin.market.alicloudapi.com";
    $path = "/dx/sendSms";
    $method = "POST";
    $appcode = "8c5c3b3d4fa748589196c68fd8ae506d";
    $headers = array();
    array_push($headers, "Authorization:APPCODE " . $appcode);
    $querys = "mobile=$phone&param=code%3A$code&tpl_id=TP1711063";
    $bodys = "";
    $url = $host . $path . "?" . $querys;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, true);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
//        var_dump(curl_exec($curl));
    $json=curl_exec($curl);
    $arr=json_decode($json,true);
//        print_r($arr);
    if ($arr["return_code"]=="0000"){
        return true;
    }else{
        return false;
    }


}
function getClassInfo($classInfo,$parent_id=0,$level=0){
    static $info=[];
    foreach ($classInfo as $k=> &$v){
        if ($v['parent_id']==$parent_id){
            $v['level']=$level;
            $info[]=$v;
            getClassInfo($classInfo,$v['id'],$level+1);
        }
    }
//    dump($info);
    return $info;
}
function uploads($arr){
//    dump($arr);die;
    $tmpName = $arr["id_photos"]["tmp_name"];
    $fileName = $arr["id_photos"]["name"];
    $ext = explode(".", $fileName)[1];

    $filePath = Date("/Y/m/d/",time());
    $filePath="./images".$filePath;
//    dump($filePath);die;
    if(!is_dir($filePath)){
        mkdir($filePath,777,true);
    }

    $num = time()+rand(1000,9999);
    $fileName = md5($num);
    $fileName  = $fileName.".{$ext}";
    $newFilePath = $filePath.$fileName;
    move_uploaded_file($tmpName, $newFilePath);
    return trim($newFilePath,".");
}

