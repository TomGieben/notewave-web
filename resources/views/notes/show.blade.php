@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <h3>{{ $note->title }}</h3>
                </div>
                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('notes.index') }}" title="Back">
                        <i class="fas fa-times text-white"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="m-4">
                {{ $note->content }}
            </div>
        </div>

        <div class="card-footer">
        </div>
    </div>
</div>
@endsection
