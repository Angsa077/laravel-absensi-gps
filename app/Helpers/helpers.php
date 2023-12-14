<?php

if (! function_exists('formatPrice')) {
    function formatPrice($str) {
        return 'Rp. ' . number_format($str, '0', '', '.');
    }
}

function selisih($jam_in, $jam_out)
{
    $jam_in_parts = explode(':', $jam_in);
    $jam_out_parts = explode(':', $jam_out);

    // Check if the exploded arrays have the required keys
    if (count($jam_in_parts) < 3 || count($jam_out_parts) < 3) {
        return 'Invalid time format';
    }

    [$h, $m, $s] = $jam_in_parts;
    $dtgAwal = mktime($h, $m, $s, '1', '1', '1');

    [$h, $m, $s] = $jam_out_parts;
    $dtgAkhir = mktime($h, $m, $s, '1', '1', '1');

    $dtgSelisih = $dtgAkhir - $dtgAwal;
    $totalMenit = $dtgSelisih / 60;
    $jam = explode('.', $totalMenit / 60);
    $sisaMenit = $totalMenit / 60 - $jam[0];
    $sisaMenit2 = $sisaMenit * 60;
    $jmlJam = $jam[0];

    return $jmlJam . ':' . round($sisaMenit2);
}
