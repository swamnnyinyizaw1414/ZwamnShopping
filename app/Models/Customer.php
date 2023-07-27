<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // public function scopeFilter($query,$filter){
    //     dd("hello");
    //     $query->when($filter['brand']??false,function($query,$brand){
    //         $query->whereHas('brand',function($query) use($brand){
    //             $query->where("slug",$brand);
    //         });
    //     });
    // }
}
