<?php

use \Morilog\Jalali\Jalalian;

function showPersianDate($date, $format)
{
    return Jalalian::forge($date)->format($format);
}

function sideBarMenuActiver($url, $hasSub = false)
{
    if ($hasSub)
        return (strpos(request()->url(), $url) === 0) ? "menuSelected" : "";
    else
        return request()->url() === $url ? "menuSelected" : "";
}

function numbers_e2f($str) {
	$persian_numbers = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
	$english_numbers = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
	return str_replace($english_numbers, $persian_numbers, $str);
}