@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Course</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="{{ route('course.index') }}">Course</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Update Course</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Course</h4>
                            <form method="POST" action="{{ route('course.update', $course->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="name">Name <span class="text text-danger"> *</span></label>
                                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name', $course->name) }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="short_name">Short Name <span class="text text-danger"> *</span></label>
                                            <input id="short_name" name="short_name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Short Name" value="{{ old('name') }}">
                                            @error('short_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="duration">Course Duration <span class="font-size-10">(In Year)</span> <span class="text text-danger"> *</span></label>
                                            <input id="duration" name="duration" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Course Duration <span>" value="{{ old('name') }}">
                                            @error('duration')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="status">Status <span class="text text-danger"> *</span></label>
                                            <select class="form-control select2 @error('status') is-invalid @enderror" title="status" name="status">
                                                <option value="">Select Status </option>
                                                @foreach (getGenStatus('general') as $key => $status)
                                                    <option value="{{ ++$key }}" {{ old('status', $course->status) == $key ? 'selected' : '' }}>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="course_level">Course Level <span class="text text-danger"> *</span></label>
                                            <select class="form-control select2 @error('course_level') is-invalid @enderror" title="course_level" name="course_level">
                                                <option value="">Select Course Level </option>
                                                @foreach ($levels as $level)
                                                    <option value="{{ $level->id }}" {{ old('course_level', $course->course_level_id) == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="department">Department <span class="text text-danger"> *</span></label>
                                            <select class="form-control select2 @error('department') is-invalid @enderror" title="department" name="department">
                                                <option value="">Select Status </option>
                                                @foreach ($departments as $dept)
                                                    <option value="{{ $dept->id }}" {{ old('department', $course->department_id) == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="description">Description </label>
                                            <textarea id="description" name="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Description">{{ old('description', $course->description) }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10">Update</button>
                                        <a href="{{ route('course.index') }}" class="waves-effect waves-light btn btn-secondary"> Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>
@endsection
