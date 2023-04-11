@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between mb-3 p-2 bg-white rounded-pill align-items-center">
        <div class="col-auto">
            <h3 class="mt-2 ms-1">{{ __('Edit profile') }}</h3>
        </div>
        <div class="col-auto">
            <a class="btn rounded-pill bg-primary" href="{{ route('home') }}" title="Back">
                <i class="fas fa-times text-white"></i>
            </a>
        </div>
    </div>

    <form action="{{ route('users.update', [$user]) }}" method="post">
        @method('PUT')
        @csrf

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="name">{{ __('Name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="email">{{ __('Email') }}</label>
                            <input class="form-control" type="text" name="email" id="email" value="{{ $user->email }}">
                        </div>
                    </div>
                    <hr class="my-4">
                    {{-- <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="password">{{ __('Current password') }}</label>
                            <input class="form-control" type="password" name="password" id="password">
                        </div>
                    </div> --}}
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="new-password">{{ __('New password') }}</label>
                            <input class="form-control" type="password" name="new_password" id="new-password">
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
