<?php

class Response
{
    public static function getJson($code,$message='',$data=array()) {
        if(!is_numeric($code)) {
            return '';
        }
        $arr = array(
            'code' => $code,
            'message' => $message,
            'data' => $data
        );
        echo json_encode($arr);
        exit;
    }
}