<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $text;
    public $link;
    public $icon;
    public $type;

    public function __construct(
        $text = 'Button',
        $link = '#',
        $icon = '',
        $type = 'primary'
    ) {
        $this->text = $text;
        $this->link = $link;
        $this->icon = $icon;
        $this->type = $type;
    }

    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}