@extends('layouts.app')

@section('content')
<div class="container">
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
    </div>
</div>
@endsection
