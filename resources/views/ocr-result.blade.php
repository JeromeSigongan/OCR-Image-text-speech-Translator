@extends('layouts.app')

@section('title', 'OCR Result')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="text-center">Extracted Text</h1>
            <div class="card mt-4">
                <div class="card-body">
                    <p class="card-text">{{ $text }}</p>
                </div>
            </div>
            <a href="/" class="btn btn-secondary btn-block mt-4">Go back</a>
        </div>
    </div>
@endsection
