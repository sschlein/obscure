<?php
/**
 * This file is part of Obscure
 *
 * @license MIT
 * @package Obscure
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Obscures secret salt hash
    |--------------------------------------------------------------------------
    |
    | This is the salt hash which is used for Obscure. Set it to a random
    | string via the config or set it per environment in your .env file.
    |
    */
    'salt' => env('OBSCURE_SALT', 'Your secret salt'),

    /*
    |--------------------------------------------------------------------------
    | Obscure length
    |--------------------------------------------------------------------------
    |
    | The length of the hash that Obscure will generate for each Id.
    |
    */
    'length' => 6,

    /*
    |--------------------------------------------------------------------------
    | Obscure alphabet
    |--------------------------------------------------------------------------
    |
    | Obscure will generate the hash based on this alphabet.
    |
    */
    'alphabet' => 'abcdefghijklmnopqrstubvxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789',
];