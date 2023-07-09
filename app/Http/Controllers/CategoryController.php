<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class CategoryController extends Controller
{
    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        $request->validate([
            "name"=>'required|min:3|max:50',
            "slug"=>['required',Rule::unique("categories")]
        ]);

        Category::create([
            "name"=>$request->name,
            "slug"=>$request->slug,
        ]);
        return redirect()->back()->with("status","A new category is added successfully...");
    }

    public function index(){
        $categories=Category::latest()->get();
        return view('category.index',compact('categories'));
    }

    public function delete($id){
        $category=Category::find($id);
        $category->delete();
        return redirect()->back()->with("status","A category is deleted...");
    }

    public function edit($id){
        $category=Category::find($id);
        return view('category.edit',compact('category'));
    }

    public function update(Request $request,$id){
        $category=Category::find($id);
        $request->validate([
            "name"=>'required|min:3|max:50',
            "slug"=>['required',Rule::unique("categories")->ignore($category->id)],
        ]);

        $category->name=$request->name;
        $category->slug=$request->slug;
        $category->save();
        return redirect(url('/category'))->with("status","A category is updated successfully...");
    }
}
