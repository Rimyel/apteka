<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MenuButton extends Component
{
    public $buttonId;
    public $functionName;
    public $label;
    public $icon;

    public function __construct($buttonId = null, $functionName = null, $label, $icon)
    {
        $this->buttonId = $buttonId;
        $this->functionName = $functionName;
        $this->label = $label;
        $this->icon = $icon;
    }

    public function render()
    {
        return view('components.menu-button');
    }
}