<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function detail(Ad $ad)
    {
        $context = [
            'ad' => $ad,
        ];
        return view('detail', $context);
    }
}
