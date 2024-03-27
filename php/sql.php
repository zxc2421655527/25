<?php



function  mysql(){
    $servername = "localhost";
    $username = "wsadmin";
    $password = "BznDmZTZJpHf4P5P!@";
    $dbname = "mjladmin";
    //ws_drainage
    //id	platformid	name	url	leadquantity	planquantiy	creationtime	updatetime	state 
    // 创建连接
    $conn =  new mysqli($servername, $username, $password, $dbname);
    // 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    } 
    return $conn;
}


function HQlist(){
    $conn = mysql();
    $sql = "SELECT * FROM ws_drainage";
    $result = $conn->query($sql);
    $data = array();
    $code="";
    $msg="";
    if ($result->num_rows > 0) {
        // 输出数据
        while($row = $result->fetch_assoc()) {
            $arr = array(
                 'id' => $row["id"], 
                 'platformid' => $row["platformid"], 
                 'name' => $row["name"], 
                 'url' => $row["url"], 
                 'state' => $row["state"], 
                 'planquantiy' => $row["planquantiy"],
                 'leadquantity' => $row["leadquantity"],
                 'creationtime' => $row["creationtime"],
                 'updatetime' => $row["updatetime"]
                 
                 );
                 
             $data[] = $arr;     
        } 
        $code = 0;
        $msg = "获取成功。";
        //id	platformid	name	url	leadquantity	planquantiy	creationtime	updatetime	state 
    } else {
        $code = 1;
        $msg = "获取失败，结果为0";

    }
        
        $conn->close();
        $json = array(
            'code' => $code,
            'msg'  => $msg,
            'data' => $data,
            );
   return json_encode($json); 
}


function UPlist($id,$name,$value,$n=true){
        $conn = mysql();
        if($n){
            $sql = "UPDATE ws_drainage SET ".$name."='".$value."' WHERE id=".$id;
        }
        elseif (!$n) {
            $sql = "UPDATE ws_drainage SET ".$name."=".$value." WHERE id=".$id;
        }
        if (mysqli_query($conn, $sql)) {
            $code="ok";
        } else {
            $code = "Error:" . $sql . "<br>" . mysqli_error($conn);
        }
            mysqli_close($conn);
            return $code;
}


function Delist($name,$value,$n=true){
        $conn = mysql();
        if($n){
            $sql = "DELETE FROM ws_drainage WHERE ".$name."='".$value."'";
        }
        elseif (!$n) {
            $sql = "DELETE FROM ws_drainage WHERE ".$name."=".$value;
        }
        if (mysqli_query($conn, $sql)) {
            $code="ok";
        } else {
            $code = "Error:" . $sql . "<br>" . mysqli_error($conn);
        }
            mysqli_close($conn);
            return $code;
}


function Inlist($name,$value){
        $conn = mysql();
        $sql = "INSERT INTO ws_drainage (".$name.") VALUES (".$value.")";
        $code=""; 
        if (mysqli_query($conn, $sql)) {
            $code="ok";
        } else {
            $code = "Error:" . $sql . "<br>" . mysqli_error($conn);
        }
         
        mysqli_close($conn);
        return $code; 
}


function sql($sql){
        $conn = mysql();
        $code=""; 
        if (mysqli_query($conn, $sql)) {
            $code="ok";
        } else {
            $code = "Error:" . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
        return $code; 
}

// 保存文件
function baocun($data,$ml){
    
    $file = $ml;
    // 打开文件获取已经存在的内容
    $current = file_get_contents($file);
    // 追加新成员到文件
    $current = $data;
    // 将内容写回文件
    file_put_contents($file, $current); 
    
    return "ok";
}
?>