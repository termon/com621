<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Survey;
use App\Services\BookService;
use Database\Factories\SurveyFactory;
use Livewire\Attributes\Rule;

class SurveyForm extends Form
{
    public ?int $id = null;

    #[Rule('required|min:5|max:30')] 
    public string $name = '';

    #[Rule('sometimes|min:0|max:300')] 
    public string $comment = '';

    #[Rule('required|integer|min:0|max:5')] 
    public int $rating = 0;

    public function setSurvey(Survey $survey): void 
    {
        // set form inputs
        $this->name = $survey->name;
        $this->rating = $survey->rating;
        $this->comment = $survey->comment;
    }

}
