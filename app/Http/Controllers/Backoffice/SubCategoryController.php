<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategory = SubCategory::latest()->get();
        return view('backoffice.admin.subcategory.all_sub_category', compact('subcategory'));
    }

    public function add()
    {
        $categoryList = Category::latest()->get();
        return view('backoffice.admin.subcategory.add_sub_category', compact('categoryList'));
    }

    public function edit($id)
    {
        $categoryList = Category::latest()->get();
        $subcategory = SubCategory::findOrFail($id);

        return view('backoffice.admin.subcategory.edit_sub_category', compact('subcategory', 'categoryList'));
    }

    public function insert(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'sub_category_name' => 'required'
        ]);

        $category = SubCategory::create([
            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name,
            'sub_category_slug' => strtolower(str_replace(' ', '-', $request->sub_category_name)),
        ]);

        $category->save();

        $notification = [
            'message' => 'Saved Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('sub-category.all')->with($notification);
    }

    public function update(Request $request)
    {
        $request->validate([
            'sub_category_name' => 'required'
        ]);

        $category = SubCategory::findOrFail($request->id);
        $category->update([
            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name,
            'sub_category_slug' => strtolower(str_replace(' ', '-', $request->sub_category_name)),
        ]);

        $notification = [
            'message' => 'Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('sub-category.all')->with($notification);
    }

    public function delete($id)
    {
        $category = SubCategory::findOrFail($id);
        $category->delete();

        $notification = [
            'message' => 'Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('sub-category.all')->with($notification);
    }
}
