<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\ArrivalGatePass;
use App\Models\ArrivalInspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArrivalGatePassController extends Controller
{
    public function index(Request $request)
    {
        $data = ArrivalGatePass::where('count', 1)->with(['inspection', 'po', 'po.crop', 'po.cropCategory', 'po.cropItem', 'po.cropType', 'po.cropYear', 'po.supplier'])->orderBy('id')->paginate(10);

        return view('pass_in.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $data = json_decode('{}');
        $data->po = PurchaseOrder::get();
        // $data->inspections = ArrivalInspection::where([['count', 1], ['status', 1]])->get();
        $data->code = generateCode('passin', 'GIN');
        return view('pass_in.create', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'po' => 'required|exists:purchase_orders,id',
            'inspection' => 'required|exists:arrival_inspections,id',
            'arrival_gate_pass_id' => 'nullable|exists:arrival_gate_passes,id',
            'date' => 'required|date',
            'pass_number' => 'required|string|max:255|unique:arrival_gate_passes,code',
            'consignee_weight' => 'required|numeric',
            'detail' => 'required|string',
            'arrival_note' => 'required|string',
        ]);

        $data = [
            'purchase_order_id' => $request->po,
            'arrival_inspection_id' => $request->inspection,
            'arrival_gate_pass_id' => $request->arrival_gate_pass_id ?? null,
            'status' => $request->status ?? 1,
            'count' => $request->count ?? 1,
            'date' => $request->date ?? now()->format('Y-m-d'),
            'code' => $request->pass_number,
            'jute_bags' => $request->jute_bags ?? 0,
            'consignee_weight' => $request->consignee_weight,
            'detail' => $request->detail,
            'note' => $request->arrival_note,
            'user_id' => Auth::id()
        ];

       ArrivalGatePass::create($data);

        return redirect()->route('pass-in.index')->with('success', 'Record created successfully');
    }

    public function show(ArrivalGatePass $arrivalGatePass)
    {
    }

    public function edit(ArrivalGatePass $arrivalGatePass)
    {
    }

    public function update(Request $request, ArrivalGatePass $arrivalGatePass)
    {
    }

    public function destroy(ArrivalGatePass $arrivalGatePass)
    {
    }
}
