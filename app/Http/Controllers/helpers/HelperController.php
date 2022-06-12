<?php

namespace App\Http\Controllers\helpers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelperController extends Controller
{
    static public function generate_password()
    {
    }

    static public function pretty_date($date)
    {
        return date('M d, Y', strtotime($date));
    }

    static public function format_date($date)
    {
        return date('M d, Y, H:i:s', strtotime($date));
    }

    static public function generate_unique_string()
    {
        $rand_no = substr(rand(0, time()), 0, 7);
        return $rand_no;
    }

    static public function calculate_total($p, $q)
    {
        return $p * $q;
    }

    static public function number_format($n)
    {
        return number_format($n, 2);
    }

    static public function user_role()
    {
        $user = Auth::user();
        if ($user) {
            if ($user->hasRole('Admin')) {
                return 'Admin';
            } elseif ($user->hasRole('Customer')) {
                return 'Customer';
            }
        } else {
            return 'Customer';
        }
    }
}