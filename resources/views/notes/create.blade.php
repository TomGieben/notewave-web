@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between mb-3 p-2 bg-white rounded-pill align-items-center">
        <div class="col-auto">
            <h3 class="mt-2 ms-1">{{ __('Create note') }}</h3>
        </div>
        <div class="col-auto">
            <a class="btn rounded-pill bg-primary" href="{{ route('notes.index') }}" title="Back">
                <i class="fas fa-times text-white"></i>
            </a>
        </div>
    </div>
    
    <form action="{{ route('notes.store') }}" method="post">
        @method('POST')
        @csrf

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-2">
                            <label for="title">{{ __('Title') }}</label>
                            <input class="form-control" type="text" name="title" id="title">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-2">
                            <label for="content">{{ __('Content') }}</label>
                            <textarea class="form-control" name="content" id="content" rows="20"></textarea>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is-public" name="is_public">
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
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
