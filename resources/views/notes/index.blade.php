@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">{{ __('Notes') }}</div>

        <div class="card-body">
            <ul class="list-group">
                @foreach ($notes as $note)
                    <li class="list-group-item">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                {{ $note->title }}
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('notes.edit', [$note]) }}" class="btn btn-warning">
                                    <i class="fas fa-pencil"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
