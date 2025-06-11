<?php

namespace App\View\Components\form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputHourInterval extends Component
{
    public string $id;
    public string $name;
    public string $label;
    public ?string $value;

    /**
     * @param string $id
     * @param string $name
     * @param string $label
     * @param string|null $value
     */
    public function __construct(string $id, string $name, string $label, ?string $value = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input-hour-interval');
    }
}
