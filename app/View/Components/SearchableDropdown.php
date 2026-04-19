<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchableDropdown extends Component
{
    public $name;
    public $id;
    public $options;
    public $selected;
    public $placeholder;
    public $required;

    public function __construct($name, $id = null, $options = [], $selected = null, $placeholder = 'Select an option', $required = false)
    {
        $this->name = $name;
        $this->id = $id ?? $name;
        $this->options = $options;
        $this->selected = $selected;
        $this->placeholder = $placeholder;
        $this->required = $required;
    }

    public function render(): View|Closure|string
    {
        return view('components.searchable-dropdown');
    }
}
