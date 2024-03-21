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

    public function archive()
    {
        $context = [
            'ads' => Ad::onlyTrashed(),
        ];

        
    }

    public function delete_ad(Ad $ad)
    {
        $ad->delete();
        return redirect('profile');
    }

    public function add_favorite(Request $request, Ad $ad)
    {
        $user = auth()->user();
        $user->favorite_ads()->attach($ad);

        return redirect(url()->previous());
    }
    public function delete_favorite(Request $request, Ad $ad)
    {
        $user = auth()->user();
        $user->favorite_ads()->detach($ad);

        return redirect(url()->previous());
    }
}
