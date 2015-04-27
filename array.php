<?php
class Myarray
{
public $array;

//var_dump (reverse($array));
    public static function  reverse($arr)
{
    $myresult = array();
    for($i = 0, $j = count($arr)-1 ; $i < count($arr) ; $i++, $j--)
    {
         $myresult[$j] =  $arr[$j];
         
    }
    return $myresult;
}

public static function second($arr)
{
     $array = array();
    while(!empty($arr))
    {
       // $array  += array_pop($arr);
        array_push($array ,array_pop($arr));
    }
    return $array;
}
}

var_dump( Myarray::second(array(1,3,4,5,6,7,8,9)));
