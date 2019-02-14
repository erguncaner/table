<?php 

namespace Table;

class Attribute
{
    public static function str($attrs)
    {
        if (empty($attrs)){
            return "";
        } else {
            $str = "";
            foreach($attrs as $key => $val){
                $str .= " ".$key.'="'.$val.'"'; 
            }
            return $str;
        }
    }
}