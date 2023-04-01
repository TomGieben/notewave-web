@extends('layouts.app')

@section('content')
<div class="container">
    <input type="hidden" name="note_share_link" value="{{ $note->getShareLink() }}">
    <input type="hidden" name="note_is_public" value="{{ $note->is_public }}">

    <ul class="nav nav-pills p-3 bg-white mb-3 rounded-pill align-items-center">
        <li class="nav-item">
            <h3 class="mt-2 ms-1">{{ __('Edit note') }}</h3>
        </li>
        <li class="nav-item ms-auto">
            <a class="btn rounded-pill bg-primary" href="{{ route('notes.index') }}" title="Back">
                <i class="fas fa-times text-white"></i>
            </a>
        </li>
    </ul>

    <form action="{{ route('notes.update', [$note]) }}" method="post">
        @method('PUT')
        @csrf

        <div class="card">
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
                    <div class="col-auto">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is-public" name="is_public" @checked($note->is_public)>
                            <label class="form-check-label" for="is-public">Public</label>
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
                        <button type="button" class="btn btn-secondary" onclick="Share.show()">
                            <i class="fa-light fa-share-nodes"></i>
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
