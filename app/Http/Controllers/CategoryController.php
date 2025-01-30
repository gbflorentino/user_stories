<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function register(CategoryRequest $request)
    {
	$category = Category::create([	   
	    'name' => $request['name'],
	    'user_id' => $request->route()->parameter('user_id')
	]);

	return response()->json([
	    'message'=> 'Category successfully created'
	], 200);
    }

    public function delete(Request $request)
    {
	$category = Category::find($request->route()->parameter('category_id'));
	if (!Gate::allows('delete', $category)) {
            return response()->json('Not Allowed', 404);
        }
	
	$category->delete();

	return response()->json(null, 204);
    }
}
