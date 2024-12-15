<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductCard extends Component
{
    public $id;           // Добавляем свойство для ID
    public $name;
    public $description;
    public $price;
    public $imagePath;
    public $brand;
    public $category;
    public $isFavorite;

    public function __construct($id, $name, $description, $price, $imagePath, $brand = null, $category = null, $isFavorite)
    {
        $this->id = $id;                       // Инициализируем ID
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->imagePath = $imagePath;
        $this->brand = $brand;
        $this->category = $category;
        $this->isFavorite = $isFavorite;
    }

    public function render()
    {
        return view('components.product-card');
    }
}