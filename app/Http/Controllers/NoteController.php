<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\SharedNote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    public function index() {
        $trashed = request()->has('trashed');
        $notes = auth()
            ->user()
            ->notes()
            ->when($trashed, function($query) {
                $query->onlyTrashed();
            })
            ->paginate(12);

        $sharedNotes = auth()
            ->user()
            ->sharedNotes()
            ->get();

        return view('notes.index', [
            'notes' => $notes,
            'sharedNotes' => $sharedNotes,
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
        $attributes['is_public'] = $request->has('is_public');
        $attributes['slug'] = Str::slug($attributes['title']);

        Note::create($attributes);

        return redirect()->route('notes.index');
    }

    public function edit($note) {
        $note = auth()->user()->findNote($note) ?? abort(404);

        return view('notes.edit', [
            'note' => $note,
        ]);
    }

    public function update(Request $request, $note) {
        $attributes = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $note = auth()->user()->findNote($note) ?? abort(203);

        $attributes['is_public'] = $request->has('is_public');
        $attributes['slug'] = Str::slug($attributes['title']);

        $note->update($attributes);

        return redirect()->route('notes.index');
    }

    public function destroy($note) {
        $note = auth()->user()->findNote($note);
        
        if($note->isShared()) {
            SharedNote::query()
                ->where([
                    'user_id' => auth()->user()->id,
                    'note_id' => $note->id,
                ])
                ->delete();
        } else {
            $note->delete();
        }

        return redirect()->route('notes.index');
    }

    public function restore($note) {
        $note = auth()->user()
            ->notes()
            ->onlyTrashed()
            ->where('slug', $note)
            ->firstOrFail();

        $note->restore();

        return redirect()->route('notes.index');
    }

    public function share($sharingKey) {
        $note = Note::query()
            ->where('sharing_key', $sharingKey)
            ->where('is_public', true)
            ->firstOrFail();

        return view('notes.show', [
            'note' => $note,
        ]);
    }

    public function add(Request $request) {
        $note = Note::query()
            ->where('sharing_key', $request->sharing_key)
            ->where('is_public', true)
            ->firstOrFail();
        
        SharedNote::create([
            'user_id' => auth()->user()->id,
            'note_id' => $note->id
        ]);
    }
}
