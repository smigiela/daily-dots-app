<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Sidebar extends Component
{
    public bool $open = false;
    public string $title = 'Default Panel';
    public string $component = '';

    protected $listeners = [
        'openPanel'
    ];

    #[On('openPanel')]
    public function openPanel(string $title, string $component): void
    {
        $this->open = true;
        $this->title = $title;
        $this->component = $component;
    }

    public function render(): ViewContract
    {
        return View::make(
            view: 'livewire.sidebar',
        );
    }
}
