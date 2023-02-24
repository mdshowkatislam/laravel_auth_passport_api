<?php
if (!function_exists('NameConcat')) {
    function NameConcat($x, $y)
    {
        $z = $x . ' ' . $y;
        return $z;
    }
}
