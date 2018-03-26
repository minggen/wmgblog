<?php
function  emMsg($str){
    echo $str;
}

/**
 * 中文字符处理
 * @param unknown $strings
 * @param unknown $start
 * @param unknown $length
 * @return string
 */
function subString($strings, $start, $length) {
    if (function_exists('mb_substr') && function_exists('mb_strlen')) {
       $sub_str = mb_substr($strings, $start, $length, 'utf8');
       return mb_strlen($sub_str, 'utf8') < mb_strlen($strings, 'utf8') ? $sub_str . '...' : $sub_str;
    }
    $str = substr($strings, $start, $length);
    $char = 0;
    for ($i = 0; $i < strlen($str); $i++) {
        if (ord($str[$i]) >= 128)
            $char++;
    }
    $str2 = substr($strings, $start, $length + 1);
    $str3 = substr($strings, $start, $length + 2);
    if ($char % 3 == 1) {
        if ($length <= strlen($strings)) {
            $str3 = $str3 .= '...';
        }
        return $str3;
    }
    if ($char % 3 == 2) {
        if ($length <= strlen($strings)) {
            $str2 = $str2 .= '...';
        }
        return $str2;
    }
    if ($char % 3 == 0) {
        if ($length <= strlen($strings)) {
            $str = $str .= '...';
        }
        return $str;
    }
}


//echo subString("从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,从前明月光,", 0, 100);