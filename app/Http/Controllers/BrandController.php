<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    public function create(){
        return view('brand.create');
    }

    public function store(Request $request){
        $request->validate([
            "name"=>'required|min:3|max:50',
            "slug"=>['required',Rule::unique("brands")]
        ]);

        Brand::create([
            "name"=>$request->name,
            "slug"=>$request->slug,
        ]);
        return redirect()->back()->with("status","A new brand is added successfully...");
    }

    public function index(){
        $brands=Brand::latest()->get();
        return view('brand.index',compact('brands'));
    }

    public function delete($id){
        $brand=Brand::find($id);
        $brand->delete();
        return redirect()->back()->with("status","A brand is deleted...");
    }

    public function edit($id){
        $brand=Brand::find($id);
        return view('brand.edit',compact('brand'));
    }

    public function update(Request $request,$id){
        $brand=Brand::find($id);
        $request->validate([
            "name"=>'required|min:3|max:50',
            "slug"=>['required',Rule::unique("brands")->ignore($brand->id)],
        ]);

        $brand->name=$request->name;
        $brand->slug=$request->slug;
        $brand->save();
        return redirect(url('/brand'))->with("status","A brand is updated successfully...");
    }
}
