@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if (Session::has($msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
                @endif
            @endforeach
        </div>

        <a class="dropdown-item mt-2 mb-2 d-flex justify-content-end" href="{{ route('admin.new-book') }}">
            <button type="button" class="btn btn-primary"> {{ __('Add New Book') }}</button>
        </a>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Table') }}</div>
                    <div class="card-body">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
