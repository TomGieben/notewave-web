<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index() {
        $notes = Note::all();

        return view('notes.index', [
            'notes' => $notes,
        ]);
    }

    public function edit(Note $note) {
        return view('notes.edit', [
            'note' => $note,
        ]);
    }

    public function update(Request $request, Note $note) {
        $validated = $request->validate([
            // 'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $note->update($validated);

        return redirect()->route('notes.index');
    }
}
