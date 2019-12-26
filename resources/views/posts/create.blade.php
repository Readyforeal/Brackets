@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <form method="POST" action="/p" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label for="post_text" class="col-form-label text-md-right">Post text</label>

                    <textarea id="post_text" type="post_text" class="form-control @error('post_text') is-invalid @enderror" name="post_text" value="{{ old('post_text') }}" required autocomplete="post_text"></textarea>

                    @error('post_text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <button type="submit" class="mt-3">Post</button>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection