<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modal extends Component
{
    public $id;
    public $title;

    public function __construct($id = null, $title = null)
    {
        $this->id = $id;
        $this->title = $title;
    }


    public function render()
    {
        return view('components.modal');
    }
}
