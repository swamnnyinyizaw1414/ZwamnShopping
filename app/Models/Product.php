<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable=["name","slug","price","discount_price","quantity","brand","category_id","user_id"];

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Brand(){
        return $this->belongsTo(Brand::class);
    }

    public function scopeFilter($query,$filter){
        $query->when($filter['search']??false,function($query,$search){
            $query->where(function($query) use ($search){
                $query->where("name","Like","%".$search."%")
                    ->orwhere("brand","Like","%".$search."%");
            });
        });

        $query->when($filter['category']??false,function($query,$category){
            $query->whereHas("category",function($query) use ($category){
                $query->where("slug",$category);
            });
        });
    }

}
