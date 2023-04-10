@extends('layouts.app')

@section('content')
<div class="container">
    <ul class="nav nav-pills p-3 bg-white mb-3 rounded-pill align-items-center">
        <li class="nav-item">
            <a title="All notes"  href="{{ route('notes.index') }}" class="nav-link bg-primary text-white rounded-pill d-flex align-items-center px-3" id="all-category">
                <i class="fa fa-notes m-1"></i>
                <span class="d-none d-md-block">All notes</span>
            </a>
        </li>
        <li class="nav-item">
            <a title="Trashcan" href="{{ route('notes.index') }}?trashed" class="nav-link bg-danger text-white rounded-pill d-flex align-items-center px-3 ms-2" id="all-category">
                <i class="fa fa-trash m-1"></i>
                <span class="d-none d-md-block">Trashcan</span>
            </a>
        </li>
        <li class="nav-item ms-auto">
            <a  title="Add note" href="{{ route('notes.create') }}" class="nav-link bg-success text-white rounded-pill d-flex align-items-center px-3"> 
                <i class="fa fa-plus m-1"></i>
                <span class="d-none d-md-block">Add Note</span>
            </a>
        </li>
    </ul>
    <div class="row">
        @if($notes->isNotEmpty())
            <h4 class="my-2">{{ __('My own notes') }}</h4>
            @foreach ($notes as $note)
                <x-note-card :note="$note"/>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info mt-2">
                    {{ __('No result was found') }}
                </div>
            </div>
        @endif

        <div class="d-flex justify-content-center">
            {{ $notes->links() }}
        </div>

        @if($sharedNotes->isNotEmpty())
            <div class="col-12">
                <hr class="my-4">
                <h4>{{ __('Notes shared with me') }}</h4>
            </div>
            @foreach ($sharedNotes as $sharedNote)
                <x-note-card :note="$sharedNote"/>
            @endforeach
        @endif
    </div>
</div>
@endsection
