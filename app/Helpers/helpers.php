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

function english_to_persian_numbers($str)
{
    $persian_numbers = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $english_numbers = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    return str_replace($english_numbers, $persian_numbers, $str);
}

function persian_to_english_numbers($str)
{
    $english_numbers = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    $persian_numbers = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    return str_replace($persian_numbers, $english_numbers, $str);
}

function price_formater($price)
{
   $formated_price = number_format($price, 0, '.', ',');
   return english_to_persian_numbers($formated_price);
}
