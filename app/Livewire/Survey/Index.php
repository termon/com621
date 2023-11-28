<?php

namespace App\Livewire\Survey;

use App\Models\Survey;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class Index extends Component
{
    use WithPagination;

    public string $search = "";

    #[Computed]
    public function surveys() {
        return Survey::where('name','like', "%{$this->search}%" )->orderBy('name','asc')->paginate(10);    
    }

    public function select(int $survey_id, $modal) {
        $this->dispatch('open-modal', $modal);
        $this->dispatch('select-survey', $survey_id);
    }
   
    #[On('survey-refresh')]
    public function render() {
        return view('livewire.survey.index')->with(
            ['surveys' => $this->surveys()]
        );
    }
}
