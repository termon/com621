<?php

namespace App\Livewire\Survey;

use App\Models\Survey;
use Livewire\Component;
use Livewire\Attributes\On;

class Show extends Component
{
    public Survey $survey;

    #[On("select-survey")]
    public function select(?int $survey_id=null) 
    {
        if (isset($survey_id)) {
            $survey = Survey::find($survey_id);         
            $this->survey = $survey;
        } 
    }

    public function delete()
    {
        $this->survey->delete();
        $this->dispatch('survey-refresh');
        $this->close();
    }
    
    public function close() {
        $this->dispatch('close');
    }
    
    public function render()
    {
        return view('livewire.survey.show');
    }
}
