@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Deduction Slab</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Deduction Slab</a></li>
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add New Deduction Slab</h4>
                            {{-- <p class="card-title-desc">Fill all information below</p> --}}
                            <form method="POST" action="{{ route('slab.store') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="form-group row mb-2">
                                        <div class="col-md-6">
                                            <label for="deduction_type">Deduction Type <span class="text text-danger"> *</span></label>
                                            <select id="deduction_type" name="deduction_type" class="form-control @error('deduction_type') is-invalid @enderror">
                                                <option value="">Select type</option>
                                                @foreach (getDeduction('types') as $key => $type)
                                                    <option value="{{ ++$key }}" {{ old('deduction_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                                @endforeach
                                            </select>
                                            @error('deduction_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="status">Status <span class="text text-danger"> *</span></label>
                                            <select id="type_status" name="status" class="form-control @error('status') is-invalid @enderror">
                                                <option value="">Select Status</option>
                                                @foreach (getGenStatus('general') as $key => $status)
                                                    <option value="{{ ++$key }}" {{ old('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <div class="col-md-6">
                                            <label for="crop" class="form-label">Crop <span class="text text-danger"> *</span></label>
                                            <select class="form-control" title="crop" name="crop" class="form-control @error('crop') is-invalid @enderror">
                                                <option value="">Select Crop </option>
                                                @foreach ($data->crops as $crop)
                                                    <option value="{{ $crop->id }}">{{ $crop->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('crop')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="item" class="form-label">Item <span class="text text-danger"> *</span></label>
                                            <select class="form-control" title="item" name="item" class="form-control @error('item') is-invalid @enderror">
                                                <option value="">Select Item </option>
                                            </select>
                                            @error('item')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <div class="col-md-6">
                                            <label for="crop_type" class="form-label">Crop Type <span class="text text-danger"> *</span></label>
                                            <select class="form-control" title="crop_type" name="crop_type" class="form-control @error('crop_type') is-invalid @enderror">
                                                <option value="">Select Type </option>
                                            </select>
                                            @error('crop_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="year" class="form-label">Year <span class="text text-danger"> *</span></label>
                                            <select class="form-control" title="year" name="year" class="form-control @error('year') is-invalid @enderror">
                                                <option value="">Select Year </option>
                                                @foreach ($data->years as $year)
                                                    <option value="{{ $year->id }}">{{ $year->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="detail">Detail </label>
                                            <textarea id="detail" name="detail" rows="3" class="form-control" placeholder="Detail">{{ old('detail') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-5">
                                            <h4 class="card-title mb-4">Input Fields</h4>
                                            <div data-repeater-list="group-a">
                                                <!-- Initial template for a single row -->
                                                <div class="row">
                                                    <div class="mb-3 col-lg-2">
                                                        <label for="from">From</label>
                                                    </div>
                                                    <div class="mb-3 col-lg-2">
                                                        <label for="to">To</label>
                                                    </div>
                                                    <div class="mb-3 col-lg-3">
                                                        <label for="deduction">Deduction (%)</label>
                                                    </div>
                                                    <div class="mb-3 col-lg-4">
                                                        <label for="remarks">Remarks</label>
                                                    </div>
                                                    <div class="mb-3 col-lg-1"></div>
                                                </div>
                                                @if (!old('from') || (is_array(old('from')) && count(old('from')) == 0))
                                                    <div data-repeater-item class="row templateRow">
                                                        <div class="mb-3 col-lg-2">
                                                            <input type="number" name="from[]" class="form-control @error('from.*') is-invalid @enderror" placeholder="Enter Deduction From" value="{{ old('from.0', '') }}">
                                                            @error('from.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-lg-2">
                                                            <input type="number" name="to[]" class="form-control @error('to.*') is-invalid @enderror" placeholder="Enter Deduction To" value="{{ old('to.0', '') }}">
                                                            @error('to.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-lg-3">
                                                            <input type="number" name="deduction[]" class="form-control @error('deduction.*') is-invalid @enderror" placeholder="Enter Deduction" value="{{ old('deduction.0', '') }}">
                                                            @error('deduction.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3 col-lg-4">
                                                            <textarea name="remarks[]" class="form-control @error('remarks.*') is-invalid @enderror" placeholder="Enter Remarks" value="{{ old('remarks.0', '') }}"></textarea>
                                                            @error('remarks.*')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <button type="button" class="btn btn-danger remove-btn">
                                                                <i class="bx bx-minus-circle me-1"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- Loop through existing rows -->
                                                @if (old('name') && count(old('name')) > 0)
                                                    @foreach(old('name', []) as $index => $name)
                                                        <div data-repeater-item class="row templateRow">
                                                            <div class="mb-3 col-lg-2">
                                                                <input type="text" name="from[]" class="form-control  @error('from.' . $index) is-invalid @enderror" placeholder="Enter Deduction From" value="{{ old('from.' . $index, '') }}">
                                                                @error('from.*')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3 col-lg-2">
                                                                <input type="text" name="to[]" class="form-control  @error('to.' . $index) is-invalid @enderror" placeholder="Enter Deduction To" value="{{ old('to.' . $index, '') }}">
                                                                @error('to.*')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3 col-lg-3">
                                                                <input type="text" name="deduction[]" class="form-control @error('deduction.' . $index) is-invalid @enderror" placeholder="Enter Deduction" value="{{ old('deduction.' . $index, '') }}">
                                                                @error('deduction.*')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3 col-lg-4">
                                                                <textarea name="remarks[]" class="form-control  @error('remarks.' . $index) is-invalid @enderror" placeholder="Enter Remarks" value="{{ old('remarks.' . $index, '') }}">
                                                                @error('deduction.*')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <button type="button" class="btn btn-danger remove-btn">
                                                                    <i class="bx bx-minus-circle me-1"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>

                                            <!-- Button to add new rows -->
                                            <div class="row">
                                                <div class="col-lg-1 offset-lg-11">
                                                    <button type="button" class="btn btn-success add-btn text-bold">
                                                        <i class="bx bx-plus-circle me-1"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10">Submit</button>
                                        <a href="{{ route('slab.index') }}" class="waves-effect waves-light btn btn-secondary"> Cancel</a>
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

        $('.select2').select2();

        // Handle crop change
        $('select[name="crop"]').on('change', function() {
            var cropId = $(this).val();
            if (cropId) {
                // Items
                $.ajax({
                    url: "{{ url('get-crop-items') }}",
                    type: "GET",
                    data: { crop_id: cropId },
                    success: function(data) {
                        var itemDropdown = $('select[name="item"]');
                        itemDropdown.empty().append('<option value="">Select Item</option>');
                        $.each(data, function(key, item) {
                            itemDropdown.append('<option value="' + item.id + '|' + item.cat.id + '">' + item.name + ' (' + item.cat.name + ')</option>');
                        });
                    }
                });
                // Types
                $.ajax({
                    url: "{{ url('get-crop-types') }}",
                    type: "GET",
                    data: { crop_id: cropId },
                    success: function(data) {
                        var typeDropdown = $('select[name="crop_type"]');
                        typeDropdown.empty().append('<option value="">Select Type</option>');
                        $.each(data, function(key, type) {
                            typeDropdown.append('<option value="' + type.id + '">' + type.name + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="item"]').empty().append('<option value="">Select Item</option>');
                $('select[name="crop_type"]').empty().append('<option value="">Select Type</option>');
            }
        });

        // Function to duplicate a row
        function duplicateRow() {
            var template = $('.templateRow').first().clone();
            template.find('input, select').val(''); // Clear the values of the new row
            template.appendTo('[data-repeater-list="group-a"]');
            bindRowEvents(template); // Bind events to new row
        }

        // Function to bind events to a row
        function bindRowEvents(row) {
            row.find('.remove-btn').on('click', function() {
                remove(row);
            });
        }

        // Function to remove a specific row
        function remove(row) {
            row.remove();
        }
        // Event listener for adding new row
        $('.add-btn').on('click', function() {
            duplicateRow();
        });

        // Initial event binding for the first row
        bindRowEvents($('.templateRow'));

    });
</script>
