<?php namespace Bantenprov\HasilSeleksi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The HasilSeleksi facade.
 *
 * @package Bantenprov\HasilSeleksi
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class HasilSeleksi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'hasil-seleksi';
    }
}
