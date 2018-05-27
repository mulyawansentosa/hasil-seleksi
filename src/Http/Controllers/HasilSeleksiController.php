<?php namespace Bantenprov\HasilSeleksi\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\HasilSeleksi\Facades\HasilSeleksi;
use Bantenprov\HasilSeleksi\Models\HasilSeleksiModel;

/**
 * The HasilSeleksiController class.
 *
 * @package Bantenprov\HasilSeleksi
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class HasilSeleksiController extends Controller
{
    public function demo()
    {
        return HasilSeleksi::welcome();
    }
}
