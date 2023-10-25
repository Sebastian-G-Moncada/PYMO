<?php

namespace App\Livewire;

use Livewire\Component;

class WelcomeComponent extends Component
{
    // public $randomAffirmation;

    // public function mount()
    // {
    //     $this->displayRandomAffirmation();
    // }


    public function render()
    {
        return view('livewire.welcome-component');
    }

    // public function displayRandomAffirmation()
    // {
    //     $affirmations = [
    //         1 => "I'm deserving of love and respect.",
    //         2 => "I'm growing and evolving every day.",
    //         // Agrega todas tus afirmaciones aquí
    //         65 => "I'm living my best life right now.",
    //     ];

    //     $randomIndex = rand(1, count($affirmations));
    //     $this->randomAffirmation = $affirmations[$randomIndex];
    // }
}
