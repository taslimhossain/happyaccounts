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
        return number_format($number, 0, '.', '').'/-';
    }
}
if(!function_exists('get_days_left')){
    function get_days_left($end_date = '')
    {
        if(!$end_date){
            return 0;
        }
        $start_date = \Carbon\Carbon::now();

        //$start_date = \Carbon\Carbon::parse('2022-02-15');
        $end_date = \Carbon\Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');
        $end_date = \Carbon\Carbon::parse($end_date);
        
        if ($start_date > $end_date) {
            $days = $end_date->diffInDays($start_date) * -1;
        } else {
            $days = $start_date->diffInDays($end_date);
        }

        echo "<pre>";
        print_r( $days );
        echo "</pre>";

        // if ($daysLeft < 0) {
        //     return 'before';
        // }
        // return $daysLeft . ' days left';
    }
}