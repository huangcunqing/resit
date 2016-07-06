<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/7/5
 * Time: 11:31
 */
namespace regist;
class regist{
    function reg($email,$password,$username,$name="user"){
        $data = array("email"=>$email,"password"=>$password,"username"=>$username,"name"=>$name);
        $data_string = json_encode($data);
        $ch = curl_init('http://gitlab.local.com/api/v3/users?private_token=wyHczqs4m3Qmadxrx6it&SUDO=root');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        $result = curl_exec($ch);


        $data=json_decode($result);
        if(isset($data->id)){
            echo "<font color='green'>恭喜注册成功！！</font>";
        }elseif($data->message=="Email has already been taken"){
            echo " <font color='red'>邮箱已被注册，请重新填写邮箱注册！</font> ";
        }elseif($data->message=="Username has already been taken"){
            echo"<font color='red'>该名字已被注册，请重新填写名字！</font>";
        }

        echo "<br>";
    }
}
