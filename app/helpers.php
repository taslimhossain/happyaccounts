<?php
// In a helper file, such as app/helpers.php
if(!function_exists('is_admin')){
    function is_admin()
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }
}
if(!function_exists('formatTaka')){
    function formatTaka($number): string
    {
        return number_format($number, 2, '.', '');
    }
}