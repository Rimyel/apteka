<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductIndexCard extends Component
{
    public $id;           // Добавляем свойство для ID
    public $name;
    public $description;
    public $price;
    public $image_path;

    public $category;

    public function __construct($id, $name, $description, $price, $image_path, $category = null)
    {
        $this->id = $id;                       // Инициализируем ID
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image_path = $image_path;
        $this->category = $category;
    }

    public function render()
    {
        return view('components.index-card');
    }
}