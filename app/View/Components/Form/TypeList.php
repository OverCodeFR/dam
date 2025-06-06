<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TypeList extends Component
{

    public string $name;
    public string $label;
    public $options;
    public $value;

    /**
     * Crée une nouvelle instance du composant.
     */
    public function __construct(string $name, string $label = '', $options = [], $value = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.type-list');
    }
}
