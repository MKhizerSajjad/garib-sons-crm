@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ ucfirst($type) }} Inspection</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">{{ ucfirst($type) }} Inspection</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">{{ ucfirst($type) }} Inspections List</li>
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
                            <h4 class="card-title">{{ ucfirst($type) }} Inspections List</h4>
                            <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                <a href="{{ route('inspection.create', ['type' => $type]) }}" class="btn btn-primary">Add New {{ ucfirst($type) }} Inspection</a>
                            </div>
                            {{-- <div class="card-title-desc card-subtitle" bis_skin_checked="1">Create responsive tables by wrapping any <code>.table</code> in <code>.table-responsive</code>to make them scroll horizontally on small devices (under 768px).</div> --}}
                            @if (count($data) > 0)
                                <div class="table-responsive" bis_skin_checked="1">
                                    <table class="table mb-0 table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Inspection</th>
                                                @if ($type == 'second' || $type == 'final')
                                                    <th>First</th>
                                                    @if ($type == 'final')
                                                        <th>Second</th>
                                                    @endif
                                                @endif
                                                <th>Date</th>
                                                <th>PO</th>
                                                <th>Product</th>
                                                <th>Transporter</th>
                                                <th>Weight</th>
                                                <th>Supplier</th>
                                                <th>Status</th>
                                                {{-- <th class="text-center">Options</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $insecp)
                                                <tr>
                                                    <td  class="text-center">{{ ++$key }}</td>
                                                    <td>{{ $insecp->code }}</td>
                                                    @if ($type == 'second' || $type == 'final')
                                                        <td>{{ $insecp->first->code ?? '' }}</td>
                                                        @if ($type == 'final')
                                                            <td>{{ $insecp->second->code }}</td>
                                                        @endif
                                                    @endif
                                                    <td>{{ $insecp->date }}</td>
                                                    <td>{{ $insecp->po->code }}</td>
                                                    <td>{{ $insecp->po->crop->name }} - {{ $insecp->po->cropCategory->name }} - {{ $insecp->po->cropItem->name }} - {{ $insecp->po->cropType->name }} - {{ $insecp->po->cropYear->name }}</td>
                                                    <td>{{ $insecp->transporter_name }}</td>
                                                    <td>{{ $insecp->consignee_weight }}</td>
                                                    <td>{{ $insecp->po->supplier->name }}</td>
                                                    <td>{!! getGenStatus('acceptance', $insecp->status, 'badge') !!}</td>
                                                    {{-- <td class="text-center"> <a href="{{ route('slab.edit', $insecp->id) }}"><i class="bx bx-pencil"></i></a></td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
