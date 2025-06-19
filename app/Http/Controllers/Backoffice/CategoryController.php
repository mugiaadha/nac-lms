<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class CategoryController extends Controller
{
    protected $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function allCategory()
    {
        $category = Category::latest()->get();
        return view('backoffice.admin.all_category', compact('category'));
    }

    public function addCategory()
    {
        return view('backoffice.admin.add_category');
    }

    public function insertCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_slug' => 'required',
            'category_image' => 'required',
        ]);

        $category = Category::create([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug,
        ]);

        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            // Resize gambar
            $resizedImage = $this->imageManager->read($image)
                ->resize(370, 246, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->toJpeg(); // atau ->toPng()

            // Simpan ke storage
            Storage::disk('public')->put("category/{$filename}", (string) $resizedImage);

            // Simpan nama file ke database
            $category['category_image'] = "category/{$filename}";
        }

        $category->save();

        $notification = [
            'message' => 'Category stored successfully',
            'alert-type' => 'success'
        ];
        return redirect(route('category.all'))->with($notification);
    }
}
