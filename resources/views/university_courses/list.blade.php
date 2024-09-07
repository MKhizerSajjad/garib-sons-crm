@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">University Courses</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="{{ route('university-courses.index') }}">University Courses</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">University Courses List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-border-left alert-dismissible fade show auto-colse-3" role="alert">
                    <i class="ri-check-double-line me-3 align-middle fs-16"></i><strong>Success! </strong>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">University Courses List</h4>
                            <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                <a href="{{ route('university-courses.create') }}" class="btn btn-primary waves-effect waves-light"> <i class="bx bx-plus me-1"></i> Assign Course</a>
                            </div>
                            {{-- <div class="card-title-desc card-subtitle" bis_skin_checked="1">Create responsive tables by wrapping any <code>.table</code> in <code>.table-responsive</code>to make them scroll horizontally on small devices (under 768px).</div> --}}
                            @if (count($data) > 0)
                                <div class="table-responsive" bis_skin_checked="1">
                                    <table class="table mb-0 table">
                                        <thead>
                                            <tr>
                                                <th width="100" class="text-center">#</th>
                                                <th>University</th>
                                                <th>Course</th>
                                                <th class="text-center" width="100">Status</th>
                                                {{-- <th class="text-center" width="100">Options</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $row)
                                                <tr>
                                                    <td  class="text-center">{{ ++$key }}</td>
                                                    <td>{{ $row->university->name}} ({{ $row->university->short_name }})</td>
                                                    <td>{{ $row->course->name}} </td>
                                                    <td class="text-center">{!! getGenStatus('general', $row->status, 'badge') !!}</td>
                                                    {{-- <td class="text-center">
                                                        <a href="#" class="edit-course" data-id="{{ $row->id }}"><i class="bx bx-pencil"></i></a>
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{-- modal --}}
                                    <div class="modal fade" id="universitCourse" tabindex="-1" aria-labelledby="universitCourseLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="universitCourseLabel">University Course Detail</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <input type="text" class="form-control" name="id" id="recipient-id">
                                                        <input type="text" class="form-control" name="status" id="recipient-status">
                                                        <input type="text" class="form-control" name="university_id" id="recipient-university_id">
                                                        <input type="text" class="form-control" name="course_id" id="recipient-course_id">
                                                        <div class="mb-3">
                                                            <label for="recipient-uni_name" class="col-form-label">University </label>
                                                            <input type="text" class="form-control" name="university" id="recipient-uni_name">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="recipient-course_name" class="col-form-label">Course </label>
                                                            <input type="text" class="form-control" name="course" id="recipient-course_name">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="recipient-required_documents" class="col-form-label">Required Documents:</label>
                                                            <textarea class="form-control" id="recipient-required_documents"></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="recipient-available_shifts" class="col-form-label">Available Shifts:</label>
                                                            <textarea class="form-control" id="recipient-available_shifts"></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="recipient-available_shifts" class="col-form-label">Available Shifts</label>
                                                            <select class="form-control select2 available-shifts" name="available_shifts[]" id="available-shifts-1" multiple="multiple" data-placeholder="Select Shifts">
                                                                @foreach (getShifts('types') as $key => $shift)
                                                                    <option value="{{ ++$key }}" @if(in_array($shift, request()->input('available_shifts', []))) selected @endif>{{ $shift }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="recipient-available_shifts" class="col-form-label">Required Documents</label>
                                                            <select class="form-control select2 required-docs" name="required_documents[]" id="required-documents-1" multiple="multiple" data-placeholder="Select Documents">
                                                                @foreach (getDocument('types') as $key => $doc)
                                                                    <option value="{{ ++$key }}" @if(in_array($doc, request()->input('required_documents', []))) selected @endif>{{ $doc }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="recipient-status" class="col-form-label" name="status">Status</label>
                                                            <select class="form-control" name="status" id="course-status-1" data-placeholder="Select Status">
                                                                @foreach (getGenStatus('general') as $key => $status)
                                                                    <option value="{{ ++$key }}" {{ old('status') == $key ? 'selected' : '' }}>{{ $status }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{ $data->links() }}
                                </div>
                            @else
                                <div class="noresult">
                                    <div class="text-center">
                                        <h4 class="mt-2 text-danger">Sorry! No Result Found</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<style>
    .w-5 {
        width: 10px !important;
    }
    .h-5 {
        height: 10px !important;
    }
    .flex.justify-between.flex-1
    {
        display: none !important;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-bs-id');
        var uni = button.getAttribute('data-bs-uni');
        var course = button.getAttribute('data-bs-course');
        var shifts = button.getAttribute('data-bs-shifts');
        var docs = button.getAttribute('data-bs-docs');

        var modal = document.getElementById('universitCourse');
        modal.querySelector('#recipient-name').value = name;
        modal.querySelector('#message-text').value = `ID: ${id}`;
    });
    // Edit Modal
    $(document).on('click', '.edit-course', function () {
        let id = $(this).attr('data-id');
        $.ajax({
            type: "GET",
            url: `{{ route('university-courses.detail', ['course' => '__COURSE_ID__']) }}`.replace('__COURSE_ID__', id),
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {

                $('#recipient-id').val(response.id);
                $('#recipient-status').val(response.status);
                $('#recipient-university_id').val(response.university_id);
                $('#recipient-course_id').val(response.course_id);
                $('#recipient-required_documents').val(response.required_documents);
                $('#recipient-available_shifts').val(response.available_shifts);
                $('#recipient-uni_name').val(`${response.university.name} (${response.university.short_name})`);
                $('#recipient-course_name').val(response.course.name);

                // Show the modal
                $('#universitCourse').modal('show');
            }
        });
    });
    // $('#universitCourse').on('visible.bs.modal', function () {
    //     console.log('modal shown')
    // })


    $('.select2').select2();
</script>
