<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller for switching the display mode: visually-impaired and default
 */
class VisionModeController extends Controller
{
    /**
     * Changes the display mode
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change(Request $request)
    {
        $mode = $request->session()->get('mode', 'default');
        $newMode = ($mode === 'default') ? 'vi' : 'default'; //vi = visually-impaired
        $request->session()->put('mode', $newMode);

        return redirect()->back();
    }
}
