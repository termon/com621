<?php

namespace App\Livewire\Survey;

use App\Models\Survey;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\SurveyForm;

class Form extends Component
{
    public ?SurveyForm $form;
    public ?Survey $survey = null;

    public function mount(?int $survey_id=null) {        
        $this->selectSurvey($survey_id);
    }

    public function isEditMode() {
        return isset($this->survey); 
    }  

    #[On("select-survey")]
    public function selectSurvey(?int $survey_id=null) {
        if (isset($survey_id)) {
            $this->survey = Survey::find($survey_id);
            if ($this->isEditMode()) {           
                $this->form->setSurvey($this->survey);
            }
        } 
    }
    
    public function cancel() {
        $this->survey = null;
        $this->form->reset();
        $this->dispatch('close');
    }

    public function save() {
        if ($this->isEditMode()) {
            $this->survey->update($this->form->validate());   
        } else {
            Survey::create($this->form->validate());  
        }        
        $this->dispatch('survey-refresh');
        $this->cancel();
    }    

    public function render() {
        return view('livewire.survey.form');
    }
}

  
