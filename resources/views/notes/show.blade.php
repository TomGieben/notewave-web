@extends('layouts.app')

@section('content')
<div class="container">
    <ul class="nav nav-pills p-3 bg-white mb-3 rounded-pill align-items-center">
        <li class="nav-item">
            <h3 class="mt-2 ms-1">{{ $note->title }}</h3>
        </li>
        <li class="nav-item ms-auto">
            <a class="btn rounded-pill bg-primary" href="{{ route('notes.index') }}" title="Back">
                <i class="fas fa-times text-white"></i>
            </a>
        </li>
    </ul>

    <div class="card">
        <div class="card-body">
            <div class="m-4">
                {{ $note->content }}
            </div>
        </div>
    </div>
</div>
@endsection
