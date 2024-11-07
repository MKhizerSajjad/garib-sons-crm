@extends('layouts.app')

@section('content')
    @guest
        @include('layouts.components.web-topbar')
    @endguest

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Create Purchase Order </h4>
                    </div>
                </div>
            </div>
            <div class="checkout-tabs">
                <div class="row">
                    <div class="col-xl-12 col-sm-12">

                        <form method="POST" action="{{ route('purchaseorder.store') }}" class="form" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div>
                                            <input type="hidden" name="status" value="1">
                                            <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
                                            <h4 class="card-title">Purchase Order Basic information</h4>
                                            <p class="card-title-desc">Fill all information below</p>
                                            <div class="form-group row mb-2">
                                                <div class="col-md-12">
                                                    <label for="po_number" class="form-label">Purchase Order Number <span class="text text-danger"> *</span></label>
                                                    <input type="text" name="po_number" class="form-control" id="po_number" value="{{ $data->poCode }}" placeholder="Enter Purchase Order Number" readonly>
                                                    @error('po_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <div class="col-md-6">
                                                    <label for="crop" class="form-label">Crop <span class="text text-danger"> *</span></label>
                                                    <select class="form-control" title="crop" name="crop" id="crop">
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
                                                    <select class="form-control" title="item" name="item" id="item">
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
                                                    <label for="type" class="form-label">Type <span class="text text-danger"> *</span></label>
                                                    <select class="form-control" title="type" name="type">
                                                        <option value="">Select Type </option>
                                                    </select>
                                                    @error('type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="year" class="form-label">Year <span class="text text-danger"> *</span></label>
                                                    <select class="form-control" title="year" name="year">
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
                                            <div class="form-group row mb-3">
                                                <label for="note" class="form-label">Note</label>
                                                <div class="col-md-12">
                                                    <textarea class="form-control" name="note" id="note" placeholder="Enter Note For Inhouse Information"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="card-title">Supplier</h4>
                                            <p class="card-title-desc">Which supplier will fullfill this order</p>

                                            <div class="form-group">
                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <label for="supplier" class="form-label">Supplier <span class="text text-danger"> *</span></label>
                                                        <select class="form-control" title="supplier" name="supplier">
                                                            <option value="">Select Supplier </option>
                                                            @foreach ($data->suppliers as $suppliers)
                                                                <option value="{{ $suppliers->id }}">{{ $suppliers->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('supplier')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="agent" class="form-label">Agent <span class="text text-danger"> *</span></label>
                                                        <select class="form-control" title="agent" name="agent">
                                                            <option value="">Select Agent </option>
                                                            {{-- @foreach ($data->agents as $agents)
                                                                <option value="{{ $agents->id }}">{{ $agents->name }}</option>
                                                            @endforeach --}}
                                                        </select>
                                                        @error('agent')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for="description" class="form-label">Details</label>
                                                    <div class="col-md-12">
                                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Detailed Description For Supplier"></textarea>
                                                        @error('description')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="card-title">Order Details</h4>
                                            <p class="card-title-desc">Fill all information below</p>

                                            <div class="form-group">
                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label for="po_date" class="form-label">Purchase Order Date <span class="text text-danger"> *</span></label>
                                                        <input type="date" name="po_date" class="form-control" id="po_date" value="{{ old('po_date', date('Y-m-d')) }}" placeholder="Purchase Order Date">
                                                        @error('po_date')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="start_date" class="form-label">Start Date <span class="text text-danger"> *</span></label>
                                                        <input type="date" name="start_date" class="form-control" id="start_date" value="{{ old('start_date') }}" placeholder="Start Date">
                                                        @error('start_date')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="delivery_date" class="form-label">Delivery Date <span class="text text-danger"> *</span></label>
                                                        <input type="date" name="delivery_date" class="form-control" id="delivery_date" value="{{ old('delivery_date') }}" placeholder="Delivery Date">
                                                        @error('delivery_date')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-12">
                                                        <label for="location" class="form-label">Location <span class="text text-danger"> *</span></label>
                                                        <select class="form-control" title="location" name="location">
                                                            <option value="">Select Location </option>
                                                            @foreach ($data->locations as $locations)
                                                                <option value="{{ $locations->id }}">{{ $locations->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('location')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <h4 class="card-title mt-4 mb-2">Delivery Modes</h4>
                                                {{-- <p class="card-title-desc">Fill all information below</p> --}}

                                                <input type="hidden" name="min_qty" id="min_qty">
                                                <input type="hidden" name="max_qty" id="max_qty">
                                                <div class="row mb-2">
                                                    <div class="col-md-2">
                                                        <label for="min_delivery_mode" class="form-label">Min. Delivery Mode <span class="text text-danger"> *</span></label>
                                                        <select class="form-control min_delivery" title="min_delivery_mode" name="min_delivery_mode" id="min_delivery_mode">
                                                            <option value="">Select Min. Delivery Mode </option>
                                                            @foreach (getDelivery('mode') as $key => $mode)
                                                                <option value="{{ ++$key }}">{{ $mode }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('min_delivery_mode')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="min_traller" class="form-label">Traller <span class="text text-danger"> *</span></label>
                                                        <input type="text" name="min_traller" class="form-control min_delivery" id="min_traller" value="{{ old('min_traller') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="Min. Traller" readonly>
                                                        @error('min_traller')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="min_truck" class="form-label">Truck <span class="text text-danger"> *</span></label>
                                                        <input type="text" name="min_truck" class="form-control min_delivery" id="min_truck" value="{{ old('min_truck') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="Min. Truck" readonly>
                                                        @error('min_truck')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="min_bag" class="form-label">Bag <span class="text text-danger"> *</span></label>
                                                        <input type="text" name="min_bag" class="form-control min_delivery" id="min_bag" value="{{ old('min_bag') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="Min. Bag" readonly>
                                                        @error('min_bag')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="min_tkatta" class="form-label">Katta <span class="text text-danger"> *</span></label>
                                                        <input type="text" name="min_katta" class="form-control min_delivery" id="min_katta" value="{{ old('min_katta') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="Min. Katta" readonly>
                                                        @error('min_katta')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="min_kg" class="form-label">KG <span class="text text-danger"> *</span></label>
                                                        <input type="text" name="min_kg" class="form-control min_delivery" id="min_kg" value="{{ old('min_kg') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="Min. KG" readonly>
                                                        @error('min_kg')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-2">
                                                        <label for="max_delivery_mode" class="form-label">Max. Delivery Mode <span class="text text-danger"> *</span></label>
                                                        <select class="form-control max_delivery" title="max_delivery_mode" name="max_delivery_mode" id="max_delivery_mode" disabled>
                                                            <option value="">Select Max. Delivery Mode </option>
                                                            @foreach (getDelivery('mode') as $key => $mode)
                                                                <option value="{{ ++$key }}">{{ $mode }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('max_delivery_mode')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="max_traller" class="form-label">Traller <span class="text text-danger"> *</span></label>
                                                        <input type="text" name="max_traller" class="form-control max_delivery" id="max_traller" value="{{ old('max_traller') }}" placeholder="Max. Traller" readonly>
                                                        @error('max_traller')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="max_truck" class="form-label">Truck <span class="text text-danger"> *</span></label>
                                                        <input type="text" name="max_truck" class="form-control max_delivery" id="max_truck" value="{{ old('max_truck') }}" placeholder="Max Truck" readonly>
                                                        @error('max_truck')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="max_bag" class="form-label">Bag <span class="text text-danger"> *</span></label>
                                                        <input type="text" name="max_bag" class="form-control max_delivery" id="max_bag" value="{{ old('max_bag') }}" placeholder="Max Bag" readonly>
                                                        @error('max_bag')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="max_katta" class="form-label">Katta <span class="text text-danger"> *</span></label>
                                                        <input type="text" name="max_katta" class="form-control max_delivery" id="max_katta" value="{{ old('max_katta') }}" placeholder="Max Katta" readonly>
                                                        @error('max_katta')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="max_kg" class="form-label">KG <span class="text text-danger"> *</span></label>
                                                        <input type="text" name="max_kg" class="form-control max_delivery" id="max_kg" value="{{ old('max_kg') }}" placeholder="Max. KG" readonly>
                                                        @error('max_kg')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <h4 class="card-title mt-4 mb-2">Delivery Terms</h4>
                                                {{-- <p class="card-title-desc">Fill all information below</p> --}}

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label for="delivery_term" class="form-label">Delivery Terms <span class="text text-danger"> *</span></label>
                                                        <select class="form-control" title="delivery_term" name="delivery_term" id="delivery_term">
                                                            <option value="">Select Delivery Terms </option>
                                                            @foreach (getDelivery('term') as $key => $mode)
                                                                <option value="{{ ++$key }}">{{ $mode }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('delivery_term')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="order_rate" class="form-label">Order Rate <span class="text text-danger"> *</span></label>
                                                        <input type="text" name="order_rate" class="form-control" id="order_rate" value="{{ old('order_rate') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="Order Rate">
                                                        @error('order_rate')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="kg_rate" class="form-label">Rate Per KG<span class="text text-danger"> *</span></label>
                                                        <input type="text" name="kg_rate" class="form-control" id="kg_rate" value="{{ old('kg_rate') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="Rate as per Delivery Term" readonly>
                                                        @error('kg_rate')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <label for="brokery_term" class="form-label">Brokery Terms <span class="text text-danger"> *</span></label>
                                                        <select class="form-control" title="brokery_term" name="brokery_term" id="brokery_term">
                                                            <option value="">Select Delivery Terms </option>
                                                            @foreach (getBroker('term') as $key => $mode)
                                                                <option value="{{ ++$key }}">{{ $mode }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('brokery_term')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="return_type" class="form-label">Replace / Reject <span class="text text-danger"> *</span></label>
                                                        <select class="form-control" title="return_type" name="return_type" id="return_type">
                                                            <option value="">Select Replace / Reject Type </option>
                                                            @foreach (getReturn('types') as $key => $mode)
                                                                <option value="{{ ++$key }}">{{ $mode }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('return_type')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <h4 class="card-title mt-4 mb-2">Freight</h4>
                                            {{-- <p class="card-title-desc">Fill all information below</p> --}}
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <label for="freight_per_kg" class="form-label">Freight Per KG <span class="text text-danger"> *</span></label>
                                                    <input type="text" name="freight_per_kg" class="form-control" id="freight_per_kg" value="{{ old('freight_per_kg') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="Freight Per KG">
                                                    @error('freight_per_kg')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="commission_per_bag" class="form-label">Commission Per Bag <span class="text text-danger"> *</span></label>
                                                    <input type="text" name="commission_per_bag" class="form-control" id="commission_per_bag" value="{{ old('commission_per_bag') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="Commission Per Bag">
                                                    @error('commission_per_bag')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="bardana_per_bag" class="form-label">Bardana Per Bag <span class="text text-danger"> *</span></label>
                                                    <input type="text" name="bardana_per_bag" class="form-control" id="bardana_per_bag" value="{{ old('bardana_per_bag') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="Bardana Per Bag">
                                                    @error('bardana_per_bag')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="misc_exp_per_bag" class="form-label">Misc Exp Per Bag <span class="text text-danger"> *</span></label>
                                                    <input type="text" name="misc_exp_per_bag" class="form-control" id="misc_exp_per_bag" value="{{ old('misc_exp_per_bag') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" placeholder="Misc Exp Per Bag">
                                                    @error('misc_exp_per_bag')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <h4 class="card-title mt-4 mb-2">Product Parameter</h4>
                                            {{-- <p class="card-title-desc">Fill all information below</p> --}}
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <label for="moisture" class="form-label">Moisture (KG) <span class="text text-danger"> *</span></label>
                                                    <input type="text" name="moisture" class="form-control" id="moisture" value="{{ old('moisture') }}" placeholder="Moisture">
                                                    @error('moisture')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="broken" class="form-label">Broken (Rs) <span class="text text-danger"> *</span></label>
                                                    <input type="text" name="broken" class="form-control" id="broken" value="{{ old('broken') }}" placeholder="Broken">
                                                    @error('broken')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="damage" class="form-label">Damange (Rs) <span class="text text-danger"> *</span></label>
                                                    <input type="text" name="damage" class="form-control" id="damage" value="{{ old('damage') }}" placeholder="Damage">
                                                    @error('damage')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="chalkey" class="form-label">Chalkey (Rs) <span class="text text-danger"> *</span></label>
                                                    <input type="text" name="chalkey" class="form-control" id="chalkey" value="{{ old('chalkey') }}" placeholder="Chalkey">
                                                    @error('chalkey')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-4">
                                                    <label for="ov" class="form-label">O.V (Rs) <span class="text text-danger"> *</span></label>
                                                    <input type="text" name="ov" class="form-control" id="ov" value="{{ old('ov') }}" placeholder="O.V">
                                                    @error('ov')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="chobba" class="form-label">Chobba (Rs) <span class="text text-danger"> *</span></label>
                                                    <input type="text" name="chobba" class="form-control" id="chobba" value="{{ old('chobba') }}" placeholder="Chobba">
                                                    @error('chobba')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="look" class="form-label">Look (Rs) <span class="text text-danger"> *</span></label>
                                                    <input type="text" name="look" class="form-control" id="look" value="{{ old('look') }}" placeholder="Look">
                                                    @error('look')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>




                                            {{-- <p class="card-title-desc">Please select your required services carefully</p> --}}
                                            <div class="mb-5">

                                                <div class="mb-3 col-sm-12 offset-sm-0 col-md-4 offset-md-8">
                                                    <h4 class="card-title mt-5">Amounts</h4>
                                                    <label for="payment_term" class="form-label">Payment Term <span class="text text-danger"> *</span></label>
                                                    <select class="form-control" title="payment_term" name="payment_term" id="payment_term">
                                                        <option value="">Select Payment Terms </option>
                                                        @foreach (getPayment('term') as $key => $term)
                                                            <option value="{{ ++$key }}">{{ $term }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('payment_term')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                {{-- <div class="mb-3 col-sm-12 offset-sm-0 col-md-4 offset-md-8">
                                                    <label>Landed Rate Per Kg </label>
                                                    <input type="text" name="land_kg_rate" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" class="form-control" placeholder="Your Desired Amount" value="{{ old('land_kg_rate') }}">
                                                </div> --}}
                                                <div class="mb-3 col-sm-12 offset-sm-0 col-md-4 offset-md-8">
                                                    <label>Weight Total Amount</label>
                                                    <input type="text" name="weight_amount" id="weight_amount" class="form-control" placeholder="Weight Total Amount" readonly>
                                                </div>
                                                <div class="mb-3 col-sm-12 offset-sm-0 col-md-4 offset-md-8">
                                                    <label>Landed Cost</label>
                                                    <input type="text" name="landed_cost" id="landed_cost" class="form-control" placeholder="Landed Cost Amount" readonly>
                                                </div>
                                                {{-- <h4 id="grand_total_words">{{ numberToWords(11) }}</h4> --}}
                                            </div>

                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">SUBMIT</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row mt-4">
                                <div class="col-sm-6">
                                    <a href="ecommerce-cart.html" class="btn text-muted d-none d-sm-inline-block btn-link">
                                        <i class="mdi mdi-arrow-left me-1"></i> Back to Shopping Cart </a>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="text-end">
                                        <a href="ecommerce-checkout.html" class="btn btn-success">
                                            <i class="mdi mdi-truck-fast me-1"></i> Proceed to Shipping </a>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row --> --}}

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">


    // Total of All Selected Services
    function updateServiceTotal() {
        let total = 0;

        const checkboxes = document.querySelectorAll('input[type="checkbox"][service-price]');

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                total += parseFloat(checkbox.getAttribute('service-price'));
            }
        });

        document.getElementById('service-total').value = total.toFixed(2);
    }

    $(document).ready(function() {

        $('.select2').select2();

        // Handle category change
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
                        var typeDropdown = $('select[name="type"]');
                        typeDropdown.empty().append('<option value="">Select Type</option>');
                        $.each(data, function(key, type) {
                            typeDropdown.append('<option value="' + type.id + '">' + type.name + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="item"]').empty().append('<option value="">Select Item</option>');
                $('select[name="type"]').empty().append('<option value="">Select Type</option>');
            }
        });

        // Handle Suppplier change
        $('select[name="supplier"]').on('change', function() {
            var supplierId = $(this).val();
            if (supplierId) {
                $.ajax({
                    url: "{{ url('get-agents') }}",
                    type: "GET",
                    data: { supplier_id: supplierId },
                    success: function(data) {
                        var agentDropdown = $('select[name="agent"]');
                        agentDropdown.empty().append('<option value="">Select Agent</option>');
                        $.each(data, function(key, agent) {
                            agentDropdown.append('<option value="' + agent.id + '">' + agent.name + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="agent"]').empty().append('<option value="">Select Agent</option>');
            }
        });

        // Function to update fields based on the selected mode for min
        function updateMinFields() {
            var selectedMode = $('#min_delivery_mode').val();
            $('#max_delivery_mode').val(selectedMode);

            // Reset all fields
            $('.min_delivery').prop('readonly', true).addClass('readonly-input');

            // Enable relevant fields based on selected mode
            switch (selectedMode) {
                case '1':
                    $('#min_traller').prop('readonly', false).removeClass('readonly-input');
                    break;
                case '2':
                    $('#min_truck').prop('readonly', false).removeClass('readonly-input');
                    break;
                case '3':
                    $('#min_bag').prop('readonly', false).removeClass('readonly-input');
                    break;
                case '4':
                    $('#min_katta').prop('readonly', false).removeClass('readonly-input');
                    break;
                case '5':
                    $('#min_kg').prop('readonly', false).removeClass('readonly-input');
                    break;
                default:
                    break;
            }
        }

        // Function to calculate values based on input for min
        function calculateMinValues() {
            var traller = parseInt($('#min_traller').val()) || 0;
            var truck = parseInt($('#min_truck').val()) || 0;
            var bag = parseInt($('#min_bag').val()) || 0;
            var katta = parseInt($('#min_katta').val()) || 0;
            var kg = parseInt($('#min_kg').val()) || 0;

            // var traller = document.getElementById(min_traller);
            // var truck = document.getElementById(min_truck);
            // var bag = document.getElementById(min_bag);
            // var katta = document.getElementById(min_katta);
            // var kg = document.getElementById(min_kg);

            // Calculate the values for all fields based on the active input field
            if (!isNaN(traller) && traller > 0) {
                $('#min_qty').val(traller);
                $('#max_qty').val(traller);

                $('#min_truck').val(traller * 2);
                $('#min_bag').val(traller * 250);
                $('#min_katta').val(traller * 500);
                $('#min_kg').val(traller * 25000);

                $('#max_traller').val(traller);
                $('#max_truck').val(traller * 2);
                $('#max_bag').val(traller * 320);
                $('#max_katta').val(traller * 640);
                $('#max_kg').val(traller * 32000);
            } else if (!isNaN(truck) && truck > 0) {
                $('#min_qty').val(truck);
                $('#max_qty').val(truck);

                $('#min_traller').val(truck / 2);
                $('#min_bag').val(truck * 125);
                $('#min_katta').val(truck * 250);
                $('#min_kg').val(truck * 12500);

                $('#max_traller').val(truck / 2);
                $('#max_truck').val(truck);
                $('#max_bag').val(truck * 160);
                $('#max_katta').val(truck * 320);
                $('#max_kg').val(truck * 16000);
            } else if (!isNaN(bag) && bag > 0) {
                $('#min_qty').val(bag);
                $('#max_qty').val(bag * 1.28);

                $('#min_traller').val(bag / 250);
                $('#min_truck').val(bag / 125);
                $('#min_katta').val(bag / 2);
                $('#min_kg').val(bag * 100);

                $('#max_traller').val(bag / 320);
                $('#max_truck').val(bag / 160);
                $('#max_bag').val(bag * 1.28);
                $('#max_katta').val(bag * 2);
                $('#max_kg').val(bag * 100);
            } else if (!isNaN(katta) && katta > 0) {
                $('#min_qty').val(bag);
                $('#max_qty').val(bag * 1.28);

                $('#min_traller').val(katta / 500);
                $('#min_truck').val(katta / 250);
                $('#min_bag').val(katta * 2);
                $('#min_kg').val(katta * 50);

                $('#max_traller').val(katta / 640);
                $('#max_truck').val(katta / 320);
                $('#max_bag').val(katta / 2);
                $('#max_katta').val(katta * 1.28);
                $('#max_kg').val(katta * 50);
            } else if (!isNaN(kg) && kg > 0) {
                $('#min_qty').val(bag);
                $('#max_qty').val(bag * 1.28);

                $('#min_traller').val(kg / 25000);
                $('#min_truck').val(kg / 12500);
                $('#min_bag').val(kg / 100);
                $('#min_katta').val(kg / 50);

                $('#max_traller').val(kg / 32000);
                $('#max_truck').val(kg / 16000);
                $('#max_bag').val(kg / 100);
                $('#max_katta').val(kg / 50);
                $('#max_kg').val(kg * 1.28);
            }
        }

        // Attach events for min
        $('#min_delivery_mode').change(function() {
            updateMinFields();
        });

        $(document).on('input', '#min_traller, #min_truck, #min_bag, #min_katta, #min_kg', function() {
            calculateMinValues();
        });

        // delivery_term calculation
        function updateRate() {
            // Get the values of delivery_term and order_rate
            var deliveryTerm = parseInt($('#delivery_term').val(), 10);
            var orderRate = parseFloat($('#order_rate').val());

            // Variable to hold the calculated rate
            var rate;

            // Perform calculation based on delivery_term value
            if (deliveryTerm === 1) {
                rate = orderRate / 40;
            } else if (deliveryTerm === 2) {
                rate = orderRate;
            } else {
                rate = ''; // Handle other cases or set default value
            }

            // Update the rate field with the calculated value
            $('#kg_rate').val(rate || '');
        }

        // Bind the updateRate function to the change event of delivery_term and order_rate
        $('#delivery_term, #order_rate').on('change keyup', updateRate);

        // PO total amount calculation
        function updatePoTotal() {
            // Get the values of delivery_term and order_rate
            var deliveryTerm = parseFloat($('#delivery_term').val());
            var minKg = parseFloat($('#min_kg').val());
            var kgRate = parseFloat($('#kg_rate').val());
            var kgFreight = parseFloat($('#freight_per_kg').val());
            var bagCoomission = parseFloat($('#commission_per_bag').val());
            var bagBardana = parseFloat($('#bardana_per_bag').val());
            var bagMisc = parseFloat($('#misc_exp_per_bag').val());

            // Variable to hold the calculated rate
            var totalWeightAmount, grandTotal, totalFreight, totalCommission, totalBardana, totalMisc, kgToBag = 0;
            kgToBag = minKg / 100;

            totalWeightAmount = minKg * kgRate;

            totalFreight = minKg * kgFreight;
            totalCommission = kgToBag * bagCoomission;
            totalBardana = kgToBag * bagBardana;
            totalMisc = kgToBag * bagMisc;
            grandTotal = totalWeightAmount + totalFreight + totalCommission + totalBardana + totalMisc;

            // Update the rate field with the calculated value
            $('#weight_amount').val(totalWeightAmount || '');
            $('#landed_cost').val(grandTotal || '');
            // $('#grand_total_words').text(grandTotal || '');
        }
        // Calculate Order Total Amount
        $('#min_delivery_mode, #min_traller, #min_truck, #min_katta, #min_kg, #delivery_term, #order_rate, #freight_per_kg, #commission_per_bag, #bardana_per_bag, #misc_exp_per_bag').on('change keyup keyup keyup keyup keyup keyup keyup keyup keyup keyup', updatePoTotal);

    });

</script>
