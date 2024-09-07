@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">University</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="{{ route('university.index') }}">University</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Update University</li>
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
                            <h4 class="card-title">Edit University</h4>
                            <form method="POST" action="{{ route('university.update', $university->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="name">Name <span class="text text-danger"> *</span></label>
                                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name', $university->name) }}">
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
                                            <input id="short_name" name="short_name" type="text" class="form-control @error('short_name') is-invalid @enderror" placeholder="Short Name" value="{{ old('short_name', $university->short_name) }}">
                                            @error('short_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="main_campus">Main Campus </label>
                                            <select class="form-control select2 @error('main_campus') is-invalid @enderror" title="main_campus" name="main_campus">
                                                <option value="">Select Main Campus </option>
                                                @foreach ($universities as $each_university)
                                                    <option value="{{ $each_university->id }}" {{ $university->university_id == $each_university->id ? 'selected' : '' }}>{{ $each_university->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="established_year">Established Year <span class="text text-danger"> *</span></label>
                                            <input id="established_year" name="established_year" type="month" class="form-control @error('established_year') is-invalid @enderror" placeholder="Established Year" value="{{ old('established_year', $university->established_year) }}">
                                            @error('established_year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="status">Status <span class="text text-danger"> *</span></label>
                                            <select class="form-control select2 @error('status') is-invalid @enderror" title="status" name="status">
                                                <option value="">Select Status </option>
                                                @foreach (getGenStatus('general') as $key => $status)
                                                    <option value="{{ ++$key }}" {{ old('status', $university->status) == $key ? 'selected' : '' }}>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="country_id">Country <span class="text text-danger"> *</span></label>
                                            <select class="form-control select2 @error('country_id') is-invalid @enderror" id="country_id"  title="country_id" name="country_id">
                                                <option value="">Select Country </option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" @if(old('country_id', $university->country_id) == $country->id) selected @endif>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="state_id">State <span class="text text-danger"> *</span></label>
                                            <select class="form-control select2 @error('state_id') is-invalid @enderror" id="state_id" title="state_id" name="state_id">
                                                <option value="">Select State </option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}"  @if(old('state_id', $university->state_id) == $state->id) selected @endif>{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('state_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="city_id">City <span class="text text-danger"> *</span></label>
                                            <select class="form-control select2 @error('city_id') is-invalid @enderror" id="city_id" title="city" name="city_id">
                                                <option value="">Select City </option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"  @if(old('city_id', $university->city_id) == $city->id) selected @endif>{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('city_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="keywords">Keywords </label>
                                            <p class="card-title-desc font-size-10 mb-0">Each keyword should be comma (<code><b>,</b></code>) seprated </p>
                                            <textarea id="keywords" name="keywords" rows="2" class="form-control" placeholder="keywords">{{ old('description', $keywords) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="description">Description </label>
                                            <textarea id="description" name="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Description">{{ old('description', $university->description) }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10">Update</button>
                                        <a href="{{ route('university.index') }}" class="waves-effect waves-light btn btn-secondary"> Cancel</a>
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
