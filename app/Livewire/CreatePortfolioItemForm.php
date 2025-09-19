<?php

namespace App\Livewire;

use App\Models\Subject;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePortfolioItemForm extends Component
{
    use WithFileUploads;

    public $students;
    public $subjects;
    public $itemType = 'file';
    public $file;
    public $url;
    public $title;
    public $description;
    public $studentId;
    public $subjectId;

    public function mount()
    {
        $this->students = User::students()->get();
        $this->subjects = Subject::all();
    }

    public function render()
    {
        return view('livewire.create-portfolio-item-form');
    }

    public function store()
    {
        $data = $this->validate([
            'studentId' => 'required|exists:users,id',
            'subjectId' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'itemType' => 'required|in:file,link',
            'file' => 'required_if:itemType,file|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'url' => 'required_if:itemType,link|url',
        ]);

        app(\App\Services\Student\PortfolioService::class)->createPortfolioItem([
            'user_id' => $this->studentId,
            'subject_id' => $this->subjectId,
            'title' => $this->title,
            'description' => $this->description,
            'item_type' => $this->itemType,
            'file' => $this->file,
            'url' => $this->url,
        ]);

        return redirect()->back()->with('success', 'Portfolio item added successfully');
    }
}
