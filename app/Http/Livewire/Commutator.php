<?php

namespace App\Http\Livewire;

use App\Libraries\Cube\Algorithm;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class Commutator extends Component
{
    public $setup;
    public $a;
    public $b;

    protected $rules = [
        'setup' => ['nullable', 'algorithm'],
        'a' => ['required', 'algorithm'],
        'b' => ['required', 'algorithm'],
    ];

    protected $validationAttributes = [
        'setup' => 'SETUP',
        'a' => 'A',
        'b' => 'B',
    ];

    public function updated($name)
    {
        $this->validateOnly($name);
    }

    public function invert()
    {
        [$this->a, $this->b] = [$this->b, $this->a];
    }

    public function render(): Renderable
    {
        try {
            $this->validate();
            $a = new Algorithm($this->a);
            $b = new Algorithm($this->b);
            $setup = $this->setup ? new Algorithm($this->setup) : null;
            $commutator = new \App\Libraries\Cube\Commutator($a, $b, $setup);
            $result = $commutator->algorithm();
            return view('livewire.commutator', compact('result'));
        } catch (\Exception $e) {
            return view('livewire.commutator');
        }
    }
}
