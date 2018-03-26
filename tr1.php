<?php
define("CURL_TIMEOUT",   20);
define("URL",            "http://openapi.youdao.com/api");
define("APP_KEY",         "4c64774e1f55b39e"); //替换为您的APPKey
define("SEC_KEY",        "wJ08MX3cmuRqtwh8x3bJB4Zvej6x8RWD");//替换为您的密钥

//翻译入口
function translate($query, $from, $to)
{
    $args = array(
        'q' => $query,
        'appKey' => APP_KEY,
        'salt' => rand(10000,99999),
        'from' => $from,
        'to' => $to,
        
    );
    $args['sign'] = buildSign(APP_KEY, $query, $args['salt'], SEC_KEY);
    $ret = call(URL, $args);
   // echo $ret;
    $ret = json_decode($ret, true);
    return $ret;
}

//加密
function buildSign($appKey, $query, $salt, $secKey)
{/*{{{*/
$str = $appKey . $query . $salt . $secKey;
$ret = md5($str);
return $ret;
}/*}}}*/

//发起网络请求
function call($url, $args=null, $method="post", $testflag = 0, $timeout = CURL_TIMEOUT, $headers=array())
{/*{{{*/
$ret = false;
$i = 0;
while($ret === false)
{
    if($i > 1)
        break;
        if($i > 0)
        {
            sleep(1);
        }
        $ret = callOnce($url, $args, $method, false, $timeout, $headers);
        $i++;
}
return $ret;
}/*}}}*/

function callOnce($url, $args=null, $method="post", $withCookie = false, $timeout = CURL_TIMEOUT, $headers=array())
{/*{{{*/
$ch = curl_init();
if($method == "post")
{
    $data = convert($args);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_POST, 1);
}
else
{
    $data = convert($args);
    if($data)
    {
        if(stripos($url, "?") > 0)
        {
            $url .= "&$data";
        }
        else
        {
            $url .= "?$data";
        }
    }
}
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
if(!empty($headers))
{
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
}
if($withCookie)
{
    curl_setopt($ch, CURLOPT_COOKIEJAR, $_COOKIE);
}
$r = curl_exec($ch);
curl_close($ch);
return $r;
}/*}}}*/

function convert(&$args)
{/*{{{*/
$data = '';
if (is_array($args))
{
    foreach ($args as $key=>$val)
    {
        if (is_array($val))
        {
            foreach ($val as $k=>$v)
            {
                $data .= $key.'['.$k.']='.rawurlencode($v).'&';
            }
        }
        else
        {
            $data .="$key=".rawurlencode($val)."&";
        }
    }
    return trim($data, "&");
}
return $args;
}/*}}}*/


 
 
 /** Json数据格式化
  * @param  Mixed  $data   数据
  * @param  String $indent 缩进字符，默认4个空格
  * @return JSON
  */
 function jsonFormat($data, $indent=null){
     
     // 对数组中每个元素递归进行urlencode操作，保护中文字符
     array_walk_recursive($data, 'jsonFormatProtect');
     
     // json encode
     $data = json_encode($data);
     
     // 将urlencode的内容进行urldecode
     $data = urldecode($data);
     
     // 缩进处理
     $ret = '';
     $pos = 0;
     $length = strlen($data);
     $indent = isset($indent)? $indent : '    ';
     $newline = "\n";
     $prevchar = '';
     $outofquotes = true;
     
     for($i=0; $i<=$length; $i++){
         
         $char = substr($data, $i, 1);
         
         if($char=='"' && $prevchar!='\\'){
             $outofquotes = !$outofquotes;
         }elseif(($char=='}' || $char==']') && $outofquotes){
             $ret .= $newline;
             $pos --;
             for($j=0; $j<$pos; $j++){
                 $ret .= $indent;
             }
         }
         
         $ret .= $char;
         
         if(($char==',' || $char=='{' || $char=='[') && $outofquotes){
             $ret .= $newline;
             if($char=='{' || $char=='['){
                 $pos ++;
             }
             
             for($j=0; $j<$pos; $j++){
                 $ret .= $indent;
             }
         }
         
         $prevchar = $char;
     }
     
     return $ret;
 }
 
 /** 将数组元素进行urlencode
  * @param String $val
  */
 function jsonFormatProtect(&$val){
     if($val!==true && $val!==false && $val!==null){
         $val = urlencode($val);
     }
 }
 

 
 //调用翻译
 $arr  = translate("food","EN","zh-CHS");

// print_r($arr)
 echo  jsonFormat($arr)
 
?>