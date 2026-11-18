<?php

use App\Models\User;

return [

    /*
     * Eloquent models holding personal data. Each must implement
     * JeffersonGoncalves\Lgpd\Contracts\HasPersonalData (use the
     * InteractsWithPersonalData trait) and declare #[PersonalData] attributes.
     */
    'models' => [
        User::class,
    ],

    /*
     * Key for the "hash" anonymize strategy. Falls back to app.key.
     * Rotating it changes every future pseudonym.
     */
    'hash_key' => env('LGPD_HASH_KEY'),

];
