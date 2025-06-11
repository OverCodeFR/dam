<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MomentDayList extends Component
{
    public ?string $id;
    public string $name;
    public $options;
    public $value;

    /**
     * @param string|null $id
     * @param string $name
     * @param string $label
     * @param $options
     * @param $value
     */
    public function __construct(?string $id, string $name, $options, $value = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->options = $options;
        $this->value = $value;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.moment-day-list');
    }
}
