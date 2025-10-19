<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PopupCards extends Component
{
    public $cards;

    public function __construct($cards = [])
    {
        $this->cards = $cards;
    }

    public function render()
    {
        return view('components.popup-cards');
    }
}
