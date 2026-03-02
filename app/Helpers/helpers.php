<?php

if (! function_exists('billing_user')) {
    function billing_user(?string $key = null): mixed
    {
        $user = session('billing.user');

        if ($key === null) {
            return $user;
        }

        return $user[$key] ?? null;
    }
}
