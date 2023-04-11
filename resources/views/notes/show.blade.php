@extends('layouts.app')

@section('content')
<div class="container">
    <input type="hidden" name="note_sharing_key" value="{{ $note->sharing_key }}">
    <input type="hidden" name="note_add_route" value="{{ route('notes.add') }}">
    <div class="row justify-content-between mb-3 p-2 bg-white rounded-pill align-items-center">
        <div class="col-auto">
            <h3 class="mt-2 ms-1">{{ $note->title }}</h3>
        </div>
        <div class="col-auto">
            <a class="btn rounded-pill bg-primary" href="{{ route('notes.index') }}" title="Back">
                <i class="fas fa-times text-white"></i>
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="m-4">
                {{ $note->content }}
            </div>
        </div>
        <div class="card-footer">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <button type="button" id="add-btn" class="btn btn-secondary" onclick="Share.add()" @disabled($note->isShared())>
                        <i class="fas fa-cloud-arrow-down"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
