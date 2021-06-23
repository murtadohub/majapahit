<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat()
    {
        // $categories = Category::latest()->paginate(5);
        $categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    public function AddCat(Request $request)
    {
        $validateDate = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Masukkan Kategori',
            'category_name.unique' => 'Kategori sudah ada',
            'category_name.max' => 'Kategori maksimal 255 karakter',
        ]);

        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'user_id'  => Auth::user()->id,
        //     'created_at' => Carbon::now()
        // ]);


        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        // Query builder
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->insert($data);

        return redirect()->back()->with('success','kategori berhasil dibuat');

        
    }
}
