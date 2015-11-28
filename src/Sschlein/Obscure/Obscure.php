<?php namespace Sschlein\Obscure;
/**
 * This file is part of Obscure
 *
 * @license MIT
 * @package Obscure
 */

use Hashids\Hashids;

class Obscure
{

    public function encode($id)
    {
        $hashids = new Hashids(config('obscure.salt'), config('obscure.length'), config('obscure.alphabet'));

        return $hashids->encode($id);
    }
}