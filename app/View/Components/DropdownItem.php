<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropdownItem extends Component
{
    public $id;
    public $label;

    public function __construct($id, $label)
    {
        $this->id = $id;
        $this->label = $label;
    }

    public function render()
    {
        return view('components.dropdown-item');
    }
}
