<?php

use Illuminate\Support\Number;

if (! function_exists('billing_user')) {
    function billing_user(?string $key = null): mixed
    {
        $user = session('billing.user');

        if ($key === null) {
            return $user;
        }

        return (is_array($user) && isset($user[$key])) ? $user[$key] : null;
    }
}

if (! function_exists('format_idr')) {
    function format_idr(float|int|string|null $amount): string
    {
        return Number::currency($amount ?? 0, 'IDR', 'id');
    }
}
