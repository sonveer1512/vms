<?php

use App\Models\Common;
use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

if (!function_exists('getuserdetail')) {
    function getuserdetail($string)
    {
        $sess = session('user_session');
        return $sess[$string] ?? '';
    }
}

?>