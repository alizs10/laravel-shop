<?php

use \Morilog\Jalali\Jalalian;

function showPersianDate($date, $format = "Y/m/d")
{
    return Jalalian::forge($date)->format($format);
}

function sideBarMenuActiver($url, $hasSub = false)
{
    if ($hasSub)
        return (strpos(request()->url(), $url) === 0) ? "sidebar-active" : "";
    else
        return request()->url() === $url ? "sidebar-active" : "";
}
function sidebarDropdownMenuActiver($url)
{
    return request()->url() === $url ? "sidebar-dropdown-menu-active" : "sidebar-dropdown-menu";
}

function sidebarDropdownActiver($base, array $routes)
{
    foreach ($routes as $route) {
        $url = route($base . '.' . $route);
        if (request()->url() === $url) {
            return [
                'btn' => "sidebar-active",
                'rotate' => 'rotate-sidebar-btn',
                'hidden' => '',
            ];
        }
    }

    return [
        'btn' => "",
        'rotate' => '',
        'hidden' => 'hidden',
    ];
}

function e2p_numbers($str)
{
    $persian_numbers = array('‍۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $english_numbers = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    return str_replace($english_numbers, $persian_numbers, $str);
}

function p2e_nuumbers($str)
{
    $english_numbers = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    $persian_numbers = array('‍۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    return str_replace($persian_numbers, $english_numbers, $str);
}

function price_formater($price)
{
   $formated_price = number_format($price, 0, '.', ',');
   return e2p_numbers($formated_price);
}
