@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('notes.update', [$note]) }}" method="post">
        @method('PUT')
        @csrf

        <div class="card">
            <div class="card-header">
                {{ __('Notes') }} | {{ $note->title }}
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-2">
                            <label for="title">{{ __('Title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ $note->title }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-2">
                            <label for="content">{{ __('Content') }}</label>
                            <textarea class="form-control" name="content" id="content" rows="20">{{ $note->content }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row justify-content-between">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                    <div class="col-auto">
                        </form>
                        <form id="delete-form" method="POST" action="{{ route('notes.destroy', [$note]) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
