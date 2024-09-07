@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Intake</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="{{ route('intake.index') }}">Intake</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Add New</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="mdi mdi-check-all me-2"></i><strong>Success! </strong>
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add New Intake</h4>
                            {{-- <p class="card-title-desc">Fill all information below</p> --}}
                            <form method="POST" action="{{ route('intake.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="university">University  <span class="text text-danger"> *</span></label>
                                            <select class="form-control select2 @error('university') is-invalid @enderror" title="university" name="university">
                                                <option value="">Select University </option>
                                                @foreach ($universities as $University)
                                                    <option value="{{ $University->id }}" {{ old('university') == $University->id ? 'selected' : '' }}>{{ $University->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('university')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="description">Description </label>
                                            <textarea id="description" name="description" rows="2" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            {{-- <div class="card"> --}}
                                                {{-- <div> --}}
                                                    <h4 class="card-title mb-2">Courses</h4>
                                                    <div data-repeater-list="group-a">
                                                        <div class="row">
                                                            <div class="mb-2 col-lg-5">
                                                                <label for="Course">Course</label>
                                                            </div>
                                                            <div class="mb-2 col-lg-2">
                                                                <label for="course_start_date">Status</label>
                                                            </div>
                                                            <div class="mb-2 col-lg-2">
                                                                <label for="shift">Avalability</label>
                                                            </div>
                                                            <div class="mb-2 col-lg-2">
                                                                <label for="required_docs">Required Docs</label>
                                                            </div>
                                                            <div class="mb-2 col-lg-1">
                                                            </div>
                                                        </div>
                                                        <div data-repeater-item class="row courseTemplateRow">
                                                            <div class="mb-1 col-lg-5">
                                                                <select class="form-control" name="course[]" id="course" required>
                                                                    <option value="">Select Course </option>
                                                                    @foreach ($courses as $status)
                                                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-1 col-lg-2">
                                                                <select class="form-control" name="required_documents[]" id="required_documents" data-placeholder="Select Status">
                                                                    @foreach (getGenStatus('general') as $key => $status)
                                                                        <option value="{{ ++$key }}" {{ old('status') == $key ? 'selected' : '' }}>{{ $status }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-1 col-lg-2">
                                                                <select class="form-control  available-shifts" name="available-shifts[]" id="available-shifts" multiple="multiple" data-placeholder="Select Shifts">
                                                                    @foreach (getShifts('types') as $key => $doc)
                                                                        <option value="{{ ++$key }}" @if(in_array($doc, request()->input('doc', []))) selected @endif>{{ $doc }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-1 col-lg-2">
                                                                <select class="form-control  required-docs" name="required_documents[]" id="required_documents" multiple="multiple" data-placeholder="Select Documents">
                                                                    @foreach (getDocument('types') as $key => $doc)
                                                                        <option value="{{ ++$key }}" @if(in_array($doc, request()->input('doc', []))) selected @endif>{{ $doc }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-1" id="removeCourse">
                                                                {{-- <button type="button" class="btn btn-danger remove-btn">
                                                                    <i class="bx bx-minus-circle me-1"></i>
                                                                </button> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Button to add new rows -->
                                                    <div class="row">
                                                        <div class="col-lg-1 offset-lg-11">
                                                            <button type="button" class="btn btn-success add-btn text-bold">
                                                                <i class="bx bx-plus-circle me-1"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                {{-- </div> --}}
                                            {{-- </div> --}}
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2 mt-5" bis_skin_checked="1">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10">Submit</button>
                                        <a href="{{ route('intake.index') }}" class="waves-effect waves-light btn btn-secondary"> Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Course
        // Function to duplicate a row
        function duplicateRow() {
            var template = $('.courseTemplateRow').first().clone();
            // template.find('input[type="number"]').val(''); // Clear input values
            template.find('input[type="date"]').val(''); // Clear input values
            template.find('select').val('').trigger('change'); // Reset select values and trigger change for select2

            // Reinitialize select2 for new select elements
            template.find('.select2').select2();

            template.appendTo('[data-repeater-list="group-a"]');
             // Add a remove button to the new row
            template.find('#removeCourse').html('<button type="button" class="btn btn-danger remove-btn"><i class="bx bx-minus-circle me-1"></i></button>');

            bindMaterialRowEvents(template); // Bind events to new row
        }

        // Function to bind events to a row
        function bindMaterialRowEvents(row) {
            row.find('.remove-btn').on('click', function() {
                removeCourse(row);
            });
        }

        // Function to remove a specific row
        function removeCourse(row) {
            row.remove();
        }

        // Event listener for adding new row
        $('.add-btn').on('click', function() {
            duplicateRow();
        });

        // Initial event binding for the first row
        bindMaterialRowEvents($('.courseTemplateRow'));

    });
</script>
