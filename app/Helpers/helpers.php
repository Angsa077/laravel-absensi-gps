<?php

if (! function_exists('formatPrice')) {
    function formatPrice($str) {
        return 'Rp. ' . number_format($str, '0', '', '.');
    }
}