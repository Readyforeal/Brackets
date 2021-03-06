@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Mobile -->
    <section class="border-bottom d-block d-sm-block d-md-none">
        <div class="row p-4 text-center">
            <div class="col-12 py-4">
                <img src="{{ $user->profile->profileImage() }}" class="rounded-circle" width="150">
            </div>
        </div>

        <div class="row text-center">
            <div class="col-4">
                <p class="lead font-weight-bold m-0">{{ $user->posts->count() }}</p>
                <p class="text-secondary">POSTS</p>
            </div>

            <div class="col-4">
                <p class="lead font-weight-bold m-0">{{ $user->profile->followers->count() }}</p>
                <p class="text-secondary">FOLLOWERS</p>
            </div>

            <div class="col-4">
                <p class="lead font-weight-bold m-0">{{ $user->following->count() }}</p>
                <p class="text-secondary">FOLLOWING</p>
            </div>
        </div>

        <div class="row p-4">
            <div class="col-12">

                <h3 class="font-weight-bold">
                    {{ $user->username }}
                    
                    @if($user->profile->dob != null)
                    -    {{ $user->profile->getAge() }}
                    @endif
                </h3>

                @if($user->profile->job_title != null)
                    <p class="m-0">{{ $user->profile->job_title }}
                @endif

                @if($user->profile->job_employer != null)
                    at {{ $user->profile->job_employer }}</p>
                @endif

                <p>{{ $user->profile->institution }} {{ $user->profile->graduation_year }}</p>

                @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit" class="text-link text-secondary">Edit profile</a>
                @endcan

                @if(auth()->user()->id != $user->id)
                <follow-button user-id='{{ $user->id }}' follows="{{ $follows }}"></follow-button>
                @endif
            </div>
        </div>
    </section>

    <!-- Desktop -->
    <section class="border-bottom d-none d-sm-none d-md-block">
        <div class="row">
            <div class="col-3 p-5">
                <img src="{{ $user->profile->profileImage() }}" class="rounded-circle img-fluid">
            </div>

            <div class="col-6 py-5">

                <h3 class="font-weight-bold">
                    {{ $user->username }}
                    
                    @if($user->profile->dob != null)
                    -    {{ $user->profile->getAge() }}
                    @endif
                </h3>

                @if($user->profile->job_title != null)
                    <p class="m-0">{{ $user->profile->job_title }}
                @endif

                @if($user->profile->job_employer != null)
                    at {{ $user->profile->job_employer }}</p>
                @endif

                <p>{{ $user->profile->institution }} {{ $user->profile->graduation_year }}</p>

                @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit" class="text-link text-secondary">Edit profile</a>
                @endcan

                @if(auth()->user()->id != $user->id)
                <follow-button user-id='{{ $user->id }}' follows="{{ $follows }}"></follow-button>
                @endif
            </div>

            <div class="col-3 align-self-center text-center">
                <p class="lead font-weight-bold m-0">{{ $user->posts->count() }}</p>
                <p class="text-secondary">POSTS</p>

                <p class="lead font-weight-bold m-0">{{ $user->profile->followers->count() }}</p>
                <p class="text-secondary">FOLLOWERS</p>

                <p class="lead font-weight-bold m-0">{{ $user->following->count() }}</p>
                <p class="text-secondary">FOLLOWING</p>
            </div>
        </div>
    </section>

    <section class="mt-5">
        <div class="row">
            <div class="col-3 d-none d-sm-none d-md-block">
                <p class="lead pt-5">About</p>
                <p class="lead">{{ $user->profile->about }}</p>

                <p class="lead pt-5">Interests</p>
                <p class="text-secondary">{{ $user->profile->interests }}</p>

                <p class="lead pt-5">Location</p>
                <p class="text-secondary">{{ $user->profile->location }}</p>
            </div>

            <div class="col-12 col-sm-12 col-md-6">
                @can('update', $user->profile)
                    <div class="mb-5">
                        <div class="pl-2">
                            <img src="{{ $user->profile->profileImage() }}" width="48" class="rounded-circle">
                        </div>

                        <form method="POST" action="/p" enctype="multipart/form-data" class="mt-3 rounded border">
                            @csrf

                            <textarea placeholder="Create post.." style="resize: none;" rows="5" id="post_text" type="post_text" class="form-control p-3 bg-light border-0 @error('post_text') is-invalid @enderror" name="post_text" value="{{ old('post_text') }}" required autocomplete="post_text"></textarea>

                            @error('post_text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="d-flex justify-content-between border-top rounded-bottom bg-light">

                                <div class="btn-group" role="group" aria-label="Add content..">
                                    <button type="button" class="btn btn-light text-secondary">
                                        <ion-icon class="lead pt-2" name="image"></ion-icon>
                                    </button>

                                    <button type="button" class="btn btn-light text-secondary">
                                        <ion-icon class="lead pt-2" name="link"></ion-icon>
                                    </button>

                                    <button type="button" class="btn btn-light text-secondary">
                                        <ion-icon class="lead pt-2" name="code"></ion-icon>
                                    </button>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-light text-secondary p-3 px-5"><ion-icon class="lead pt-2" name="send"></ion-icon></button>
                                </div>
                            </div>

                        </form>
                    </div>
                @endcan

                @foreach($posts as $post)
                <div class="card mt-3">
                    <div class="card-header bg-light border-0">
                        <div class="row">

                            <div class="col-1 pl-2">
                                <img src="{{ $user->profile->profileImage() }}" width="48" class="rounded-circle">
                            </div>

                            <div class="col-11 pl-4">
                                <a href="/profile/{{ $post->user->id }}" class="m-0">{{ $post->user->username }}</a>
                                <p class="text-secondary">{{ $post->created_at->format('d-m-Y') }}</p>
                            </div>

                        </div>
                    </div>

                    <div class="card-body bg-light">
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
                                <div class="form-group mt-3">
                                    <textarea placeholder="Comment.." style="resize: none;" rows="5" id="comment_text" type="comment_text" class="form-control bg-light border-0 rounded-0 @error('post_text') is-invalid @enderror" name="comment_text" value="{{ old('comment_text') }}" required autocomplete="comment_text"></textarea>

                                    @error('comment_text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="d-flex justify-content-between mt-2">

                                        <div class="btn-group" role="group" aria-label="Add content..">
                                            <button type="button" class="btn btn-light">
                                                <ion-icon class="lead pt-2" name="image"></ion-icon>
                                            </button>

                                            <button type="button" class="btn btn-light">
                                                <ion-icon class="lead pt-2" name="link"></ion-icon>
                                            </button>

                                            <button type="button" class="btn btn-light">
                                                <ion-icon class="lead pt-2" name="code"></ion-icon>
                                            </button>
                                        </div>

                                        <div>
                                            <button type="submit" class="btn btn-light p-2 px-5">Post</button>
                                        </div>

                                    </div>
                                </div>
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
