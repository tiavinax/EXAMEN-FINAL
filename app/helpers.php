<?php
// app/helpers.php

if (!function_exists('base_url')) {
    function base_url($path = '') {
        $baseUrl = Flight::get('flight.base_url');
        return $baseUrl . '/' . ltrim($path, '/');
    }
}

if (!function_exists('asset_url')) {
    function asset_url($path) {
        return base_url('assets/' . ltrim($path, '/'));
    }
}