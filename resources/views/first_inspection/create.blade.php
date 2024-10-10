@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">First Inspection</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="{{ route('first-inspection.index') }}">First Inspection</a></li>
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
                            <h4 class="card-title">Add New First Inspection</h4>
                            {{-- <p class="card-title-desc">Fill all information below</p> --}}
                            <form method="POST" action="{{ route('first-inspection.store') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="count" value="1">
                                    <div class="form-group row mt-3 mb-2">
                                        <div class="col-md-4">
                                            <label for="inspection_number" class="form-label">Inspection Number <span class="text text-danger"> *</span></label>
                                            <input type="text" name="inspection_number" class="form-control" id="inspection_number" value="{{ $data->code }}" placeholder="Enter Purchase Order Number" readonly>
                                            @error('inspection_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="date">Date <span class="text text-danger"> *</span></label>
                                            <input type="date" id="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                                            @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
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
                                    </div>

                                    <div class="form-group row mt-3 mb-2">
                                        <div class="col-md-8">
                                            <label for="product" class="form-label">Product <span class="text text-danger"> *</span></label>
                                            <input type="text" name="product" class="form-control @error('po') is-invalid @enderror" id="product" value="{{ old('product') }}" placeholder="Product ">
                                            @error('po')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="supplier" class="form-label">Supplier <span class="text text-danger"> *</span></label>
                                            <input type="text" name="supplier" class="form-control @error('po') is-invalid @enderror" id="supplier" value="{{ old('supplier') }}" placeholder="Supplier">
                                            @error('po')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <div class="form-group row mb-2">
                                        <div class="col-md-4">
                                            <label for="status">Status <span class="text text-danger"> *</span></label>
                                            <select id="type_status" name="status" class="form-control @error('status') is-invalid @enderror">
                                                <option value="">Select Status</option>
                                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Accept</option>
                                                <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Reject</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="bags_no">Bags No <span class="text text-danger"> *</span></label>
                                            <input type="number" id="bags_no" name="bags_no" class="form-control @error('bags_no') is-invalid @enderror" value="{{ old('bags_no') }}" required>
                                            @error('bags_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="pp_bags">PP Bags <span class="text text-danger"> *</span></label>
                                            <input type="number" id="pp_bags" name="pp_bags" class="form-control @error('pp_bags') is-invalid @enderror" value="{{ old('pp_bags') }}" required>
                                            @error('pp_bags')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <h4 class="card-title mt-3">Delivery Details</h4>
                                    <div class="form-group row mb-2">
                                        <div class="col-md-3">
                                            <label for="jute_bags">Jute Bags <span class="text text-danger"> *</span></label>
                                            <input type="text" id="jute_bags" name="jute_bags" class="form-control @error('jute_bags') is-invalid @enderror"  oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" value="{{ old('jute_bags') }}">
                                            @error('jute_bags')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="consignee_weight">Consignee Weight (KG) <span class="text text-danger"> *</span></label>
                                            <input type="text" id="consignee_weight" name="consignee_weight" class="form-control @error('consignee_weight') is-invalid @enderror"  oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" value="{{ old('consignee_weight') }}">
                                            @error('consignee_weight')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="bilty_no">Bilty No <span class="text text-danger"> *</span></label>
                                            <input type="text" id="bilty_no" name="bilty_no" class="form-control @error('bilty_no') is-invalid @enderror" value="{{ old('bilty_no') }}">
                                            @error('bilty_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="bilty_date">Bilty Date <span class="text text-danger"> *</span></label>
                                            <input type="date" id="bilty_date" name="bilty_date" class="form-control @error('bilty_date') is-invalid @enderror" value="{{ old('bilty_date') }}">
                                            @error('bilty_date')
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
                                            <input type="text" id="transporter_name" name="transporter_name" class="form-control @error('transporter_name') is-invalid @enderror" value="{{ old('transporter_name') }}">
                                            @error('transporter_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <div class="col-md-3">
                                            <label for="vechile_type">Vehicle Type <span class="text text-danger"> *</span></label>
                                            <input type="number" id="vechile_type" name="vechile_type" class="form-control @error('vechile_type') is-invalid @enderror" value="{{ old('vechile_type') }}">
                                            @error('vechile_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> --}}
                                        <div class="col-md-3">
                                            <label for="vechile_number">Vehicle Number <span class="text text-danger"> *</span></label>
                                            <input type="text" id="vechile_number" name="vechile_number" class="form-control @error('vechile_number') is-invalid @enderror" value="{{ old('vechile_number') }}">
                                            @error('vechile_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="driver_name">Driver Name <span class="text text-danger"> *</span></label>
                                            <input type="text" id="driver_name" name="driver_name" class="form-control @error('driver_name') is-invalid @enderror" value="{{ old('driver_name') }}">
                                            @error('driver_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="driver_phone">Driver Phone <span class="text text-danger"> *</span></label>
                                            <input type="text" id="driver_phone" name="driver_phone" class="form-control @error('driver_phone') is-invalid @enderror" value="{{ old('driver_phone') }}">
                                            @error('driver_phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <h4 class="card-title mt-3">PO Requirements</h4>
                                    <table class="mt-3 table table-bordered table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center">Moisture (%)</th>
                                                <th class="text-center">Damage (%)</th>
                                                <th class="text-center">Chalky (%)</th>
                                                <th class="text-center">Broken (%)</th>
                                                <th class="text-center">Look (%)</th>
                                                <th class="text-center">O.V (RS)</th>
                                                <th class="text-center">Chobba (RS)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="data-row" style="display: none;">
                                                <td class="text-center" id="moisture">-</td>
                                                <td class="text-center" id="damage">-</td>
                                                <td class="text-center" id="chalky">-</td>
                                                <td class="text-center" id="broken">-</td>
                                                <td class="text-center" id="look">-</td>
                                                <td class="text-center" id="ov">-</td>
                                                <td class="text-center" id="chobba">-</td>
                                            </tr>
                                            <tr id="no-record">
                                                <td colspan="7" class="text text-danger text-center font-size-18">Select PO for details.</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <h4 class="card-title mt-3 mb-0">Inspection Parameters</h4>
                                    <table class="mt-3 table table-bordered table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center">Particulars</th>
                                                <th class="text-center">Rating</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $index = 0;
                                            @endphp
                                            @foreach (getDelivery('quality') as $key => $value)
                                                <tr id="data-row">
                                                    <td>
                                                        <input type="hidden" value="{{ ++$index }}" id="params-{{$key}}" name="params[]">
                                                        {{ is_array($value) ? implode(', ', $value) : $value }}
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" id="rating-{{$key}}" name="rating[]" class="form-control @error('rating.' . $key) is-invalid @enderror" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="{{ old('rating.' . $key) }}">
                                                        @error('rating.' . $key)
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                        {{-- <input type="text" id="rating-{{$index}}" name="rating[]" class="form-control @error('rating') is-invalid @enderror" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" value="{{ old('rating-' . $index) }}"> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{-- <div class="form-group row mt-3 mb-2">
                                        <div class="col-md-4">
                                            <input type="text" id="po_weight" name="po_weight" class="form-control @error('po_weight') is-invalid @enderror" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" value="{{ old('po_weight') }}" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" id="rate" name="rate" class="form-control @error('rate') is-invalid @enderror" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" value="{{ old('rate') }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" id="rate" name="rate" class="form-control @error('rate') is-invalid @enderror" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" value="{{ old('rate') }}" required>
                                        </div>
                                    </div> --}}

                                    <div class="form-group row mt-3 mb-2">
                                        <div class="col-md-12">
                                            <label for="status">Status <span class="text text-danger"> *</span></label>
                                            <select id="type_status" name="status" class="form-control @error('status') is-invalid @enderror">
                                                <option value="">Select Status</option>
                                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Accept</option>
                                                <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Reject</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="form-group row mb-2">
                                        <div class="col-md-12">
                                            <label for="attachement">Attachment</label>
                                            <input type="file" id="attachement" name="attachement" class="form-control @error('attachement') is-invalid @enderror" value="{{ old('attachement') }}">
                                            @error('attachement')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    <div class="form-group row mt-3 mb-2">
                                        <div class="col-md-12">
                                            <label for="detail">Detail</label>
                                            <textarea id="detail" name="detail" class="form-control @error('detail') is-invalid @enderror">{{ old('detail') }}</textarea>
                                            @error('detail')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10">Submit</button>
                                        <a href="{{ route('first-inspection.index') }}" class="waves-effect waves-light btn btn-secondary"> Cancel</a>
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
                    url: "{{ url('get-po') }}",
                    type: "GET",
                    data: { po_id: poId },
                    success: function(data) {
                        $('#product').val(data.crop_category.name+', '+ data.crop_item.name+', '+ data.crop_type.name+', '+ data.crop_year.name);
                        $('#supplier').val(data.supplier.name);

                        // call heper functuin here
                        // $('#po_weight').val(data.min_delivery_mode+'|'+data.min_qty);
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
                    }
                });
            } else {
                $('select[name="item"]').empty().append('<option value="">Select Item</option>');
            }
        });
    });
</script>
