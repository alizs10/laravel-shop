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

function categoriesForSmallScreens($categories)
{
    $container = '';

    foreach ($categories as $key => $cat) {
        $container = categoryAndSubCategoriesGenerator($cat, 0);
    }

    echo $container;
}

$categoriesContainer = "";

function categoryAndSubCategoriesGenerator($category, $number)
{
    global $categoriesContainer;
    if ($category->children->count() > 0) {
        $categoriesContainer .= '
    <span id="s-c-' . $category->id . '"
     class="s-cat flex justify-between py-3 text-gray-500 dark:text-gray-400 cursor-pointer">
        <span class="text-xs mr-' . (($number * 4) + 2) . '">' . $category->name . '</span>
        <span class="ml-2 text-xs">
            <i class="fa-solid fa-angle-left"></i>
        </span>
    </span>
    ';
    } else {
        $categoriesContainer .= '
        <a href="" class="mr-10 text-xs py-3">' . $category->name . '</a>
        ';
    }


    if ($category->children->count() > 0) {
        $categoriesContainer .= '
        <ul id="s-c-s-' . $category->id . '" class="hidden w-full flex flex-col bg-gray-300 dark:bg-gray-900">
        ';
        foreach ($category->children as $key => $child) {
            $categoriesContainer = categoryAndSubCategoriesGenerator($child, $key);
        }
        $categoriesContainer .= '
        </ul>
        ';
    }

    return $categoriesContainer;
}
