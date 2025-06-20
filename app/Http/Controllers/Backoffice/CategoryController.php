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

    public function index()
    {
        $category = Category::latest()->get();
        return view('backoffice.admin.category.all_category', compact('category'));
    }

    public function add()
    {
        return view('backoffice.admin.category.add_category');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backoffice.admin.category.edit_category', compact('category'));
    }

    public function insert(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_image' => 'required',
        ]);

        $category = Category::create([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            // Resize gambar
            $resizedImage = $this->imageManager->read($image)
                ->resize(370, 246, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->toJpeg();
            // atau ->toPng()

            // Simpan ke storage
            Storage::disk('public')->put("category/{$filename}", (string) $resizedImage);

            // Simpan nama file ke database
            $category['category_image'] = "category/{$filename}";
        }

        $category->save();

        $notification = [
            'message' => 'Saved Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('category.all')->with($notification);
    }

    public function update(Request $request)
    {
        $request->validate([
            'category_name' => 'required'
        ]);

        $category = Category::findOrFail($request->id);
        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            // Resize gambar
            $resizedImage = $this->imageManager->read($image)
                ->resize(370, 246, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->toJpeg();
            // atau ->toPng()

            // Simpan ke storage
            Storage::disk('public')->put("category/{$filename}", (string) $resizedImage);

            // Simpan nama file ke database
            $category->update(['category_image' => "category/{$filename}"]);
        }

        $notification = [
            'message' => 'Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('category.all')->with($notification);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        $notification = [
            'message' => 'Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('category.all')->with($notification);
    }
}
