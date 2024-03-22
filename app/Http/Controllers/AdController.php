<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
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
            'ads' => Ad::onlyTrashed()->where('user_id', auth()->user()->id)->get(),
        ];

        return view('archive', $context);
    }

    public function add_form()
    {
        $context = [
            'categories' => Category::get(),
            'cities' => City::get(),
        ];
        return view('adform', $context);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'photo' => 'required',
            'name' => 'required',
            'price' => 'nullable|numeric',
            'description' => 'min:5',
            'phone' => 'max:12|min:12',
        ]);

        $user = auth()->user();
        $ad = [
            'title' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'phone_number' => $validated['phone'],
            'category_id' => $request['category'],
            'city_id' => $request['city'],
        ];

        if($request['photo']){
            $file = $request->file('photo');
            $file_name = (string) time() . '_'. $file->getClientOriginalName();
            $file->move(public_path('uploads/article'), $file_name);
            $ad['photo_path'] = 'uploads/article/' . $file_name;
        }

        $user->ad()->create($ad);

        return redirect()->route('profile');
    }

    public function unarchive(Ad $ad)
    {
        $ad->restore();
        return redirect()->back();
    }

    public function delete(Ad $ad)
    {
        $ad->delete();
        return redirect()->back();
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
