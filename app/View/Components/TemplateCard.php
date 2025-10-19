<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TemplateCard extends Component
{
    public $title;
    public $type;
    public $image;

    public function __construct($title, $type, $image)
    {
        $this->title = $title;
        $this->type = $type;
        $this->image = $image;
    }

    public function render()
    {
        return view('components.template-card');
    }
}
