<?php

if (!function_exists('pre')) {
    function pre($data, $die = FALSE){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        if($die) die;
        return false;
    }
}

if (!function_exists('rupiah')) {
    function rupiah($number){
        $formattedNumber = number_format($number, 0, ',', '.');
        return "Rp. ".$formattedNumber; // Output: 1.000.000
    }
}