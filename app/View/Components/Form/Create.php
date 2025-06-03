<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Create extends Component
{
    public string $action;
    public ?string $title;
    public ?string $description;
    public ?string $submit;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $action,
        string $title = null,
        string $description = null,
        string $submit = null
    ) {
        $this->action = $action;
        $this->title = $title;
        $this->description = $description;
        $this->submit = $submit;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.create');
    }
}
