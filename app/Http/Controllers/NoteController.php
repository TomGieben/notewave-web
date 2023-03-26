<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    public function index() {
        $notes = auth()->user()->notes()->get();

        return view('notes.index', [
            'notes' => $notes,
        ]);
    }

    public function create() {
        return view('notes.create');
    }

    public function store(Request $request) {
        $attributes = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $attributes['user_id'] = auth()->user()->id;
        $attributes['slug'] = Str::slug($attributes['title']);

        Note::create($attributes);

        return redirect()->route('notes.index');
    }

    public function edit($note) {
        $note = auth()->user()
            ->notes()
            ->where('slug', $note)
            ->firstOrFail();

        return view('notes.edit', [
            'note' => $note,
        ]);
    }

    public function update(Request $request, Note $note) {
        $attributes = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $attributes['slug'] = Str::slug($attributes['title']);

        $note->update($attributes);

        return redirect()->route('notes.index');
    }

    public function destroy($note) {
        $note = auth()->user()
            ->notes()
            ->where('slug', $note)
            ->firstOrFail();

        $note->delete();

        return redirect()->route('notes.index');
    }
}
