<?php

//$wsurl = "http://".$_SERVER['HTTP_HOST']."/asebyws";
//header('Location: '.$wsurl);
//return;
$a_folder = 'php/'; // 文件夹名称$id_file = $a_folder . 'id.txt'; 
$str = file_get_contents('id.txt')."\n";//将整个文件内容读入到一个字符串中 
$str .= file_get_contents('id2.txt');
$str_encoding = mb_convert_encoding($str, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');//转换字符集（编码）
$array = explode("\n", $str_encoding);//转换成数组 

$filteredArray = array_filter($array, function($value) {  
    return $value !== null && $value !== "";  
}); 


$randomKey = array_rand($filteredArray );  
$randomIndex = array_rand($filteredArray , 1);  
$wsurl = $filteredArray [$randomIndex];  
header('Location: http://'.$wsurl);

$ip = 获取外网IP();  
$currentTime = date('Y-m-d H:i:s'); 
$currentDate = date('Ymd').".txt"; 
$userdata = huoqu($currentDate);
$userdata .=  $currentTime."----".$ip."----".获取终端类型()."----".$wsurl."\n";
baocun($userdata,$currentDate);

function 获取终端类型() {
    // 获取用户代理字符串  
    $userAgent = $_SERVER['HTTP_USER_AGENT'];  
    // 判断终端类型并存储在变量中  
    $terminalType = '';  
    if (preg_match('/Mobile|Android/i', $userAgent)) {  
        $terminalType = "移动设备终端";  
    } elseif (preg_match('/Windows/i', $userAgent)) {  
        $terminalType = "电脑终端";  
    } elseif (preg_match('/Mac/i', $userAgent)) {  
        $terminalType = "苹果电脑终端";  
    } elseif (preg_match('/iPad|iPhone/i', $userAgent)) {  
        $terminalType = "苹果平板或手机终端";  
    } elseif (preg_match('/Android|BlackBerry|iPhone|Windows Phone/i', $userAgent)) {  
        $terminalType = "其他移动设备终端";  
    } else {  
        $terminalType = "未知终端类型";  
    }  
    return  $terminalType ;   
}

function 获取外网IP() {  

    $ip_address = '';  
    
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];  
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED'])) {  
        $ip_address = $_SERVER['HTTP_X_FORWARDED'];  
    } elseif (!empty($_SERVER['HTTP_FORWARDED_FOR'])) {  
        $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];  
    } elseif (!empty($_SERVER['HTTP_FORWARDED'])) {  
        $ip_address = $_SERVER['HTTP_FORWARDED'];  
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {  
        $ip_address = $_SERVER['REMOTE_ADDR'];  
    }  
   
    return  $ip_address;


}


$tj = huoqu('tj.txt') + 1; //记录本链接被访问次数
baocun($tj,'tj.txt');

function huoqu($daml){
$str = file_get_contents($daml); 
$str_encoding = mb_convert_encoding($str, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');
return $str_encoding;
}


function baocun($data,$daml){
    
    $file = $daml;
    // 打开文件获取已经存在的内容
    $current = file_get_contents($file);
    // 追加新成员到文件
    $current = $data;
    // 将内容写回文件
    file_put_contents($file, $current); 
}
?>

