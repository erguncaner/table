<?php 
/*
 * This file is part of the erguncaner/table.
 * (c) Caner Ergün <erguncaner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace erguncaner\Table;

/**
 * Support class for html attributes
 * 
 * @author Caner Ergün <erguncaner@gmail.com>
 */
class Attribute
{
    /**
     * Returns combined attributes as string
     * 
     * @param string $attrs
     * 
     * @return string
     */
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