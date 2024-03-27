<?php

$key = $_GET["key"];
if ($key!="199522henaiY") {exit;} //key密码自己修改

require 'sql.php';

$n = $_GET["n"];

$data = $_GET["data"];

switch ($n)
{
case 1:
    echo HQlist();
    break;
case 2:
    echo sql($data);
    break;
case 3:
    echo GXlist($data);
    break;
case 4:
    echo SClist($data);
    break;
case 5:
    echo CRlist($data);
    break;
case 6:
    echo BCid($data,"id.txt");
    break;  
case 7:
    echo BCid($data,"id2.txt");
    break;   
default:
    
}

function GXlist($data){
    $json = json_decode($data);
    $id = $json -> {'id'};
    $name = $json -> {'name'};
    $value = $json -> {'value'};
    return UPlist($id,$name,$value);
}

function SClist($data){
    $json = json_decode($data);
    $name = $json -> {'name'};
    $value = $json -> {'value'};
    return Delist($name,$value,false);
}

function CRlist($data){
    $json = json_decode($data);
    $name = $json -> {'name'};
    $value = $json -> {'value'};
    return Inlist($name,$value);
}

function BCid($data,$name){
    $str_encoding = mb_convert_encoding($data, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');//转换字符集（编码）
    $arr = explode(";", $str_encoding);//转换成数组 
    foreach ($arr as &$row) 
    { 
    $row = trim($row); 
    } 
    unset($row); 
    $arr = array_unique($arr);
    $arr = array_filter($arr);    
    $k=count($arr);
    $userid="";
    for ($i=0; $i<$k; $i++){
        $userid .= $arr[$i]."\n";
    }
    return baocun($userid,$name);
    
}


?>