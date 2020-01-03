@extends('layouts.app-sidebar')

@section('content')

    @can('update', $user->profile)
        <div class="mb-5">
            <div class="pl-2">
                <img src="{{ $user->profile->profileImage() }}" width="48" class="rounded-circle">
            </div>

            <form method="POST" action="/p" enctype="multipart/form-data" class="mt-3 border rounded">
                @csrf

                <textarea placeholder="Create post.." style="resize: none;" rows="5" id="post_text" type="post_text" class="form-control p-3 bg-light text-secondary rounded-top border-0 @error('post_text') is-invalid @enderror" name="post_text" value="{{ old('post_text') }}" required autocomplete="post_text"></textarea>

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

                        <button type="button" class="btn btn-light text-secondary" data-toggle="modal" data-target="#code-modal">
                            <ion-icon class="lead pt-2" name="code"></ion-icon>
                        </button>
                    </div>

                    <div class="modal fade w-100" id="code-modal" tabindex="-1" role="dialog" aria-labelledby="code-modal-label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="code-modal-label">Paste code</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <textarea class="form-control" id="editor">

                                    </textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>

                            </div>
                        </div>
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
                    <img src="{{ $post->user->profile->profileImage() }}" width="48" class="rounded-circle">
                </div>
                <div class="col-11 pl-4">
                    <p class="m-0">{{ $post->user->profile->name ?? $post->user->email }}</p>
                    <p>{{ $post->created_at->format('d-m-Y') }}</p>
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

@endsection