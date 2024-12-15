<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_path',
        'name',
        'price',
        'count',
        'category_id',
        'brand_id',
        'AdministrationAndDosage',
        'indications',
        'composition',
        'contraindications',
        'SpecialInstructions',
        'PackagingForm',
        'SideEffects',
        'TempStorage',
        'SpecialStorage',
        'shelf_life',
        'manufacturer',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class); 
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
}

