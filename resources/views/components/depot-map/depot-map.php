<?php

use App\Models\Depot;
use Livewire\Component;

new class extends Component
{
    public Depot $depot;

    public function mount(Depot $depot)
    {
        $this->depot = $depot;
    }
};
