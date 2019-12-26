@extends('layouts.app')

@section('content')
<div class="container">
    <section class="mt-5">
        <div class="row">
            <div class="col-3">
                <img src="/storage/{{ $user->profile->profile_image }}" class="img-fluid">
            </div>

            <div class="col-9 p-5">
                <h3 class="font-weight-bold">{{ $user->profile->name }}, {{ $user->profile->getAge() }}</h3>
                <p class="m-0">{{ $user->profile->job_title }} at {{ $user->profile->job_employer }}</p>
                <p>{{ $user->profile->institution }} {{ $user->profile->graduation_year }}</p>
                <p class="lead">{{ $user->profile->about }}</p>
            </div>
        </div>
    </section>

    <section class="mt-5">
        <div class="row">
            <div class="col-3">
                @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit" class="text-link text-secondary">Edit profile</a>
                @endcan

                <p class="lead pt-5">Interests</p>
                <p class="text-secondary">{{ $user->profile->interests }}</p>

                <p class="lead pt-5">Location</p>
                <p class="text-secondary">{{ $user->profile->location }}</p>
            </div>

            <div class="col-6 pl-5">
                @can('update', $user->profile)
                    <form method="POST" action="/p" enctype="multipart/form-data" class="mb-5">
                        @csrf
                        <div class="form-group">
                            <textarea style="resize: none;" rows="4" id="post_text" type="post_text" class="form-control bg-light border-bottom-0 rounded-0 @error('post_text') is-invalid @enderror" name="post_text" value="{{ old('post_text') }}" required autocomplete="post_text"></textarea>

                            @error('post_text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <button type="submit" class="rounded-0 btn btn-block btn-outline-secondary px-4">Post</button>

                        </div>
                    </form>
                @endcan

                @foreach($posts as $post)
                <div class="card mt-3">
                    <div class="card-header bg-white border-0">
                        <div class="row">
                            <div class="col-1 pl-2">
                                <img src="/storage/{{ $user->profile->profile_image }}" width="48" class="rounded-circle">
                            </div>
                            <div class="col-11 pl-4">
                                <p class="m-0">{{ $user->profile->name ?? $user->email }}</p>
                                <p>{{ $post->created_at->format('d-m-Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p>{{ $post->post_text }}</p>
                        
                        <button type="button" class="btn btn-link text-secondary p-0" data-toggle="collapse" data-target="#collapse-{{ $post->id }}" aria-expanded="false" aria-controls="collapseOne">Comment</button>

                        <div class="collapse" id="collapse-{{ $post->id }}">
                            <form method="POST" action="/p/{{ $post->id }}/comment" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group pt-3">
                                    <textarea id="comment_text" type="text" class="form-control" name="comment_text"></textarea>
                                </div>
                                <button type="submit" class="btn btn-block btn-light">Post comment</button>
                            </form>
                        </div>

                        <div class="p-3">
                        @foreach($post->comments as $comment)
                        <div class="pt-3 border-bottom">
                        
                            @if($comment->user->profile->name == '')
                                <p>{{ $comment->user->email}}</p>
                            @endif

                            @if($comment->user->profile->name != '')
                                <p>{{ $comment->user->profile->name}}</p>
                            @endif

                            <p>{{ $comment->comment_text }}</p>

                        </div>
                        @endforeach
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
