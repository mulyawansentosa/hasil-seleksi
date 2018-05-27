<?php namespace Bantenprov\HasilSeleksi\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The HasilSeleksiModel class.
 *
 * @package Bantenprov\HasilSeleksi
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class HasilSeleksiModel extends Model
{
    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'hasil_seleksi';

    /**
    * The attributes that are mass assignable.
    *
    * @var mixed
    */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
