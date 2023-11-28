<?php

namespace App\Livewire\Survey;

use App\Models\Survey;
use Livewire\Component;
use App\Services\BookService;
use App\Livewire\Forms\SurveyForm;

class Create extends Component
{
    public SurveyForm $form;

    public function save(): void
    {
        Survey::create($this->form->validate());  
        $this->js('$wire.$parent.$refresh()');
        $this->close();
    }

    public function close() {
        $this->form->reset();       
        $this->dispatch('close');
    }

    public function render()
    {
        return view('livewire.survey.create');
    }
}
