<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductCart extends Component
{
    public $id;           // Добавляем свойство для ID
    public $name;
    public $description;
    public $price;
    public $imagePath;
    public $brand;
    public $category;
    public $maxQuantity;

    public function __construct($id, $name, $description, $price, $imagePath, $brand = null, $category = null, $maxQuantity = 0)
    {
        $this->id = $id;                       // Инициализируем ID
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->imagePath = $imagePath;
        $this->brand = $brand;
        $this->category = $category;
        $this->maxQuantity = $maxQuantity; 
    }

    public function render()
    {
        return view('components.product-card');
    }
}