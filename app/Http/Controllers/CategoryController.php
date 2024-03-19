<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        $ads = $category->ad()->get();
        $context = [
            'category' => $category,
            'ads' => $ads,
        ];
        return view('category', $context);
    }
}
