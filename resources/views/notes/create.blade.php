@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('notes.store') }}" method="post">
        @method('POST')
        @csrf

        <div class="card">
            <div class="card-header">
                {{ __('Notes') }} | New
            </div>

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
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
