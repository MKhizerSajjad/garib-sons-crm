@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Gate Pass In</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="{{ route('first-weighbridge.index') }}">Gate Pass In</a></li>
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
                            <h4 class="card-title">Add New Gate Pass In</h4>
                            {{-- <p class="card-title-desc">Fill all information below</p> --}}
                            <form method="POST" action="{{ route('first-weighbridge.store') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="count" value="1">
                                    <div class="form-group row mt-3 mb-2">
                                        <div class="col-md-3">
                                            <label for="weighbridge_number" class="form-label">Weigh Bridge Number <span class="text text-danger"> *</span></label>
                                            <input type="text" name="weighbridge_number" class="form-control" id="weighbridge_number" value="{{ $data->code }}" placeholder="Enter Purchase Order Number" readonly>
                                            @error('weighbridge_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="date">Date <span class="text text-danger"> *</span></label>
                                            <input type="date" id="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                                            @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="po">Purchase Order <span class="text text-danger"> *</span></label>
                                            <select id="po" name="po" class="form-control @error('po') is-invalid @enderror">
                                                <option value="">Select PO</option>
                                                @foreach ($data->po as $po)
                                                    <option value="{{ $po->id }}" {{ old('po') == $po->id ? 'selected' : '' }}>{{ $po->code }}</option>
                                                @endforeach
                                            </select>
                                            @error('po')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="inspection">Insepction <span class="text text-danger"> *</span></label>
                                            <select id="inspection" name="inspection" class="form-control @error('inspection') is-invalid @enderror">
                                                <option value="">Select Insepction</option>
                                                {{-- @foreach ($data->inspection as $inspection)
                                                    <option value="{{ $inspection->id }}" {{ old('inspection') == $inspection->id ? 'selected' : '' }}>{{ $inspection->code }}</option>
                                                @endforeach --}}
                                            </select>
                                            @error('inspection')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="pass">Gate Pass In <span class="text text-danger"> *</span></label>
                                            <select id="pass" name="pass" class="form-control @error('pass') is-invalid @enderror">
                                                <option value="">Select Gate Pass In</option>
                                                {{-- @foreach ($data->pass as $pass)
                                                    <option value="{{ $pass->id }}" {{ old('pass') == $pass->id ? 'selected' : '' }}>{{ $pass->code }}</option>
                                                @endforeach --}}
                                            </select>
                                            @error('pass')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <h4 class="card-title mt-3">Delivery Details</h4>
                                    <div class="form-group row mb-2">
                                        <div class="col-md-6">
                                            <label for="consignee_weight">Consignee Weight (KG) <span class="text text-danger"> *</span></label>
                                            <input type="text" id="consignee_weight" name="consignee_weight" class="form-control @error('consignee_weight') is-invalid @enderror"  oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" value="{{ old('consignee_weight') }}" readonly>
                                            @error('consignee_weight')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="bilty_no">Bilty No <span class="text text-danger"> *</span></label>
                                            <input type="text" id="bilty_no" name="bilty_no" class="form-control @error('bilty_no') is-invalid @enderror" value="{{ old('bilty_no') }}" readonly>
                                            @error('bilty_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3 mb-2">
                                        <div class="col-md-12">
                                            <label for="detail">Detail <span class="text text-danger"> *</span></label>
                                            <textarea id="detail" name="detail" class="form-control @error('detail') is-invalid @enderror">{{ old('detail') }}</textarea>
                                            @error('detail')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <h4 class="card-title mt-3 mb-2">Transporter Details</h4>
                                    <div class="form-group row mb-2">
                                        <div class="col-md-3">
                                            <label for="transporter_name">Transporter Name <span class="text text-danger"> *</span></label>
                                            <input type="text" id="transporter_name" name="transporter_name" class="form-control @error('transporter_name') is-invalid @enderror" value="{{ old('transporter_name') }}" readonly>
                                            @error('transporter_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="vechile_number">Vehicle Number <span class="text text-danger"> *</span></label>
                                            <input type="text" id="vechile_number" name="vechile_number" class="form-control @error('vechile_number') is-invalid @enderror" value="{{ old('vechile_number') }}" readonly>
                                            @error('vechile_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="driver_name">Driver Name <span class="text text-danger"> *</span></label>
                                            <input type="text" id="driver_name" name="driver_name" class="form-control @error('driver_name') is-invalid @enderror" value="{{ old('driver_name') }}" readonly>
                                            @error('driver_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="driver_phone">Driver Phone <span class="text text-danger"> *</span></label>
                                            <input type="text" id="driver_phone" name="driver_phone" class="form-control @error('driver_phone') is-invalid @enderror" value="{{ old('driver_phone') }}" readonly>
                                            @error('driver_phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mt-2 mb-2">
                                        <div class="col-md-12">
                                            <label for="arrival_note">Arrival Note <span class="text text-danger"> *</span></label>
                                            <textarea id="arrival_note" name="arrival_note" class="form-control @error('arrival_note') is-invalid @enderror">{{ old('arrival_note') }}</textarea>
                                            @error('arrival_note')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10">Submit</button>
                                        <a href="{{ route('first-weighbridge.index') }}" class="waves-effect waves-light btn btn-secondary"> Cancel</a>
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

        $('select[name="po"]').on('change', function() {
            var poId = $(this).val();
            if (poId) {
                $.ajax({
                    url: "{{ url('get-inspections') }}",
                    type: "GET",
                    data: { po_id: poId },
                    success: function(data) {
                        var inspectionDropdown = $('select[name="inspection"]');
                        inspectionDropdown.empty().append('<option value="">Select Inspection</option>');
                        $.each(data, function(key, inspection) {
                            inspectionDropdown.append('<option value="' + inspection.id + '">' + inspection.code + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="inspection"]').empty().append('<option value="">Select Inspection</option>');
            }
        });

        $('select[name="inspection"]').on('change', function() {
            var inspId = $(this).val();
            if (inspId) {
                $.ajax({
                    url: "{{ url('get-insp-details') }}",
                    type: "GET",
                    data: { inspection_id: inspId },
                    success: function(data) {
                        $('#bilty_no').val(data.bilty_no);
                        $('#vechile_number').val(data.vechile_number);
                        $('#driver_name').val(data.driver_name);
                        $('#driver_phone').val(data.driver_phone);
                        $('#transporter_name').val(data.transporter_name);
                        $('#consignee_weight').val(data.consignee_weight);
                        // table
                        $('#moisture').text(data.moisture);
                        $('#damage').text(data.damage);
                        $('#chalky').text(data.chalky);
                        $('#broken').text(data.broken);
                        $('#look').text(data.look);
                        $('#ov').text(data.o_v);
                        $('#chobba').text(data.chobba);
                        $('#data-row').show();
                        $('#no-record').hide();
                    },
                    error: function(xhr) {
                        console.error('Error fetching crop items:', xhr);
                        // Handle error (optional)
                    }
                });
            } else {
                $('select[name="item"]').empty().append('<option value="">Select Item</option>');
            }
        });
    });
</script>
