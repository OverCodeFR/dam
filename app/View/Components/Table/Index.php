<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Index extends Component
{
    public $title, $description, $routeSearch, $routeCreate, $headers, $pagination, $search;

    public function __construct($title, $description, $routeSearch = '#', $routeCreate = null, $headers = [], $pagination = null, $search = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->routeSearch = $routeSearch;
        $this->routeCreate = $routeCreate;
        $this->headers = $headers;
        $this->pagination = $pagination;
        $this->search = $search;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.index');
    }
}
