<?php

function generate_coupon_codes($total, $length)
{
    $coupons = [];
    $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    for ($i = 0; $i < $total; $i++) {
        $string_shuffled = str_shuffle($string);
        $coupons[] = substr($string_shuffled, 0, $length);
    }

    return $coupons;
}