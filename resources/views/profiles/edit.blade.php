@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4 offset-4">
            <form method="POST" action="/profile/{{ $user->id }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="border rounded p-3 my-3">
                    <label for="profile_image" class="col-form-label text-md-right">Profile image</label>
                    <input type="file" class="form-control-file" id="profile_image" name="profile_image">

                    @if ($errors->has('profile_image'))
                        <strong>{{ $errors->first('image') }}</strong>
                    @endif
                </div>
                        
                <div class="border rounded px-3 my-3">
                    <div class="mb-0">
                        <button class="btn btn-lg btn-block text-left p-0 py-3" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Basic Info <span class="float-right">-</span>
                        </button>
                    </div>

                    <div class="collapse" id="collapseOne">

                        <div class="form-group">
                            <label for="name" class="col-form-label text-md-right">First name</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ?? $user->profile->name ?? '' }}" autocomplete="name">
                        </div>

                        <div class="form-group">
                            <label for="gender" class="col-form-label text-md-right">Gender</label>
                            <select id="gender" class="form-control" name="gender" value="{{ old('gender') ?? $user->profile->gender ?? '' }}" autocomplete="gender">
                                <option>Male</option>
                                <option>Female</option>
                            <select>
                        </div>

                        <div class="form-group">
                            <label for="dob" class="col-form-label text-md-right">Birthday</label>
                            <input id="dob" type="date" class="form-control" name="dob" value="{{ old('dob') ?? $user->profile->dob ?? '' }}" autocomplete="dob">
                        </div>

                        <div class="form-group">
                            <label for="about" class="col-form-label text-md-right">About you</label>
                            <textarea id="about" type="text" class="form-control" name="about" autocomplete="about">{{ old('about') ?? $user->profile->about ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="border rounded px-3 my-3">
                    <div class="mb-0">
                        <button class="btn btn-lg btn-block text-left p-0 py-3" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Work & Education <span class="float-right">-</span>
                        </button>
                    </div>

                    <div class="collapse" id="collapseTwo">

                        <div class="form-group pt-4">
                            <p class="lead">Work</p>
                        </div>

                        <div class="form-group">
                            <label for="job_employer" class="col-form-label text-md-right">Company</label>
                            <input id="job_employer" type="text" class="form-control" name="job_employer" value="{{ old('job_employer') ?? $user->profile->job_employer ?? '' }}" autocomplete="job_employer">
                        </div>

                        <div class="form-group">
                            <label for="job_title" class="col-form-label text-md-right">Job title</label>
                            <input id="job_title" type="text" class="form-control" name="job_title" value="{{ old('job_title') ?? $user->profile->job_title ?? '' }}" autocomplete="job_title">
                        </div>

                        <div class="form-group pt-4">
                            <p class="lead">Education</p>
                        </div>

                        <div class="form-group">
                            <label for="institution" class="col-form-label text-md-right">Institution</label>
                            <input id="institution" type="text" class="form-control" name="institution" value="{{ old('institution') ?? $user->profile->institution ?? '' }}" autocomplete="institution">
                        </div>

                        <div class="form-group">
                            <label for="graduation_year" class="col-form-label text-md-right">Graduation year</label>
                            <input id="graduation_year" type="text" class="form-control" name="graduation_year" value="{{ old('graduation_year') ?? $user->profile->graduation_year ?? '' }}" autocomplete="graduation_year">
                        </div>
                    </div>
                </div>

                <div class="border rounded px-3 my-3">
                    <div class="mb-0">
                        <button class="btn btn-lg btn-block text-left p-0 py-3" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Interests <span class="float-right">-</span>
                        </button>
                    </div>

                    <div class="collapse" id="collapseThree">

                        <div class="form-group pt-4">
                            <p>Separate interests with a comma ','</p>
                        </div>

                        <div class="form-group">
                            <label for="interests" class="col-form-label text-md-right">Interests</label>
                            <textarea id="interests" type="text" class="form-control" name="interests" autocomplete="interests">{{ old('interests') ?? $user->profile->interests ?? '' }}</textarea>
                        </div>

                    </div>
                </div>

                <div class="border rounded px-3 my-3">
                    <div class="mb-0">
                        <button class="btn btn-lg btn-block text-left p-0 py-3" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Location <span class="float-right">-</span>
                        </button>
                    </div>

                    <div class="collapse" id="collapseFour">

                        <div class="form-group">
                            <label for="location" class="col-form-label text-md-right">eg. Phoenix, AZ</label>
                            <input id="location" type="text" class="form-control" name="location" value="{{ old('location') ?? $user->profile->location ?? '' }}" autocomplete="location">
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-lg btn-outline-dark">Save</button>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection