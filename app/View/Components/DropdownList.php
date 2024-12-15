<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropdownList extends Component
{
    public $header;
    public $items;

    public function __construct($header, $items)
    {
        $this->header = $header;
        $this->items = $items;
    }

    public function render()
    {
        return view('components.dropdown-list');
    }
}
