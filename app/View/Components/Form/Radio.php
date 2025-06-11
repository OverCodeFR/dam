<?php

namespace App\View\Components\form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Radio extends Component
{
    public string $id;
    public string $name;
    public string $value;
    public bool $checked = false;
    public string $onchange = '';
    public string $label = '';


    /**
     * @param string $id
     * @param string $name
     * @param string $value
     * @param bool $checked
     * @param string $onchange
     * @param string $label
     */
    public function __construct(string $id, string $name, string $value, bool $checked = false, string $onchange = '', string $label = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->checked = $checked;
        $this->onchange = $onchange;
        $this->label = $label;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.radio');
    }
}
