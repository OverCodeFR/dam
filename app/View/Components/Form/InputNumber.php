<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputNumber extends Component
{
    public string $name;
    public string $label;

    public function __construct(string $name, string $label)
    {
        $this->name = $name;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input-number');
    }
}
