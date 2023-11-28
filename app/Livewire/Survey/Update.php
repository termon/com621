<?php

namespace App\Livewire\Survey;

use App\Models\Survey;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\SurveyForm;

class Update extends Component
{
    public ?Survey $survey; // survey being edited

    public SurveyForm $form;

    #[On("select-survey")]
    public function select(?int $survey_id=null) 
    {
        if (isset($survey_id)) {
            $survey = Survey::find($survey_id); 
            $this->survey = $survey;        
            $this->form->setSurvey($survey);
        } 
    }
    
    public function update(): void 
    {       
        $this->survey->update($this->form->validate());         

        // sends refresh to parent without needing event 
        //$this->js('$wire.$parent.$refresh()');

        // send refresh event to be handled by parent
        $this->dispatch('survey-refresh');

        $this->close();
    }

    public function close() 
    {
        $this->form->reset();    
        $this->dispatch('close');
    }

    public function render()
    {
        return view('livewire.survey.update');
    }
}
