<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisionModeController extends Controller
{
    public function change(Request $request)
    {
        $mode = $request->session()->get('mode', 'default');
        $newMode = ($mode === 'default') ? 'vi' : 'default'; //vi = visually-impaired
        $request->session()->put('mode', $newMode);

        return redirect()->back();
    }
}
