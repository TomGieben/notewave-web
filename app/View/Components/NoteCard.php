<?php

namespace App\View\Components;

use App\Models\Note;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NoteCard extends Component
{
    public Note $note;
    /**
     * Create a new component instance.
     */
    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.note-card');
    }
}
