<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Controller responsible for actions with ads
 */
class AdController extends Controller
{
    /**
     * Shows ad detail page
     *
     * @param Ad $ad Ad object passed via GET
     * @return View
     */
    public function detail(Ad $ad)
    {
        //Context to throw ad to view
        $context = [
            'ad' => $ad,
        ];

        //Сheck if the user has viewed the ad for fair counter
        $user_id = Auth::id();
        $viewed_ads = session("viewed_ads_{$user_id}", []);
        //If not, increase view counter of ad
        if(!isset($viewed_ads[$ad->id])){
            $viewed_ads[$ad->id] = true;
            session(["viewed_ads_{$user_id}" => $viewed_ads]);
            $ad->view++;
            $ad->save();
        }

        return view('detail', $context);
    }

    /**
     * Shows ads of category
     *
     * @param Category $category Category object passed via GET
     * @return View
     */
    public function category(Category $category)
    {
        //Get all ads of category
        $ads = $category->ad()->get();
        //Context to throw ads to view
        $context = [
            'category' => $category,
            'ads' => $ads,
        ];
        return view('category', $context);
    }

    /**
     * Show archive page
     *
     * @return View
     */
    public function archive()
    {
        //Context to throw deleted ads
        $context = [
            'ads' => Ad::onlyTrashed()->where('user_id', auth()->user()->id)->get(),
        ];
        return view('archive', $context);
    }

    /**
     * Show ad creation form
     *
     * @return View
     */
    public function add_form()
    {
        //Context to throw categories and cities to form
        $context = [
            'categories' => Category::get(),
            'cities' => City::get()
        ];
        return view('adform', $context);
    }

    /**
     * Add new ad.
     *
     * This method adds a new ad based on the data retrieved from the query.
     *  Validates the data, loads the image if provided, and stores the declaration in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        //Validate data
        $validated = $request->validate([
            'photo' => 'required',
            'name' => 'required',
            'price' => 'nullable|numeric',
            'description' => 'min:5',
            'phone' => 'max:12|min:12',
        ]);

        //Make new ad object
        $ad = [
            'title' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'phone_number' => $validated['phone'],
            'category_id' => $request['category'],
            'city_id' => $request['city'],
        ];

        //Download photo
        if($request['photo']){
            $file = $request->file('photo');
            $file_name = (string) time() . '_'. $file->getClientOriginalName();
            $file->move(public_path('uploads/article'), $file_name);
            $ad['photo_path'] = 'uploads/article/' . $file_name;
        }

        //Сreate an ad in the database belonging to an authorized user
        $user = auth()->user();
        $user->ad()->create($ad);

        return redirect()->route('profile');
    }

    /**
     * Restore deleted ad.
     *
     * @param Ad $ad Ad object passed via POST
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unarchive(Ad $ad)
    {
        $ad->restore();
        return redirect()->back();
    }

    /**
     * Soft delete ad.
     *
     * @param Ad $ad Ad object passed via POST
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Ad $ad)
    {
        $ad->delete();
        return redirect()->back();
    }

    /**
     * Add ad to favorite.
     *
     * @param Ad $ad Ad object passed via POST
     * @return \Illuminate\Routing\Redirector
     */
    public function add_favorite(Ad $ad)
    {
        $user = auth()->user();
        $user->favorite_ads()->attach($ad);

        return redirect(url()->previous());
    }

    /**
     * Delete ad from favorite
     *
     * @param Ad $ad Ad object passed via POST
     * @return \Illuminate\Routing\Redirector
     */
    public function delete_favorite(Ad $ad)
    {
        $user = auth()->user();
        $user->favorite_ads()->detach($ad);

        return redirect(url()->previous());
    }
}
