<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Search extends Component
{
    public string $action;
    public ?string $placeholder;

    public function __construct(string $action, string $placeholder = 'Rechercher...')
    {
        $this->action = $action;
        $this->placeholder = $placeholder;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.search');
    }
}
