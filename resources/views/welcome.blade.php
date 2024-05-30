@extends('layouts.app')

@section('title', 'Image to Text OCR')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="text-center">Image to Text OCR</h1>
            <form action="/process-image" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="form-group">
                    <label for="image">Upload an image:</label>
                    <input type="file" name="image" id="image" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Convert</button>
            </form>
        </div>
    </div>
@endsection
