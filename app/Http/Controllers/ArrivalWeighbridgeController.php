<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\ArrivalGatePass;
use App\Models\ArrivalInspection;
use App\Models\ArrivalWeighbridge;
use App\Models\Weighbridge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArrivalWeighbridgeController extends Controller
{
    public function index(Request $request)
    {
        $data = ArrivalWeighbridge::where('count', 1)->with(['location', 'pass', 'inspection', 'po', 'po.crop', 'po.cropCategory', 'po.cropItem', 'po.cropType', 'po.cropYear', 'po.supplier'])->orderBy('id')->paginate(10);

        return view('first_weighbridge.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $data = json_decode('{}');
        $data->po = PurchaseOrder::get();
        $data->locations = Weighbridge::get(); //->groupBy('type');
        $data->code = generateCode('passin', 'WBR-1');
        return view('first_weighbridge.create', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'po' => 'required|exists:purchase_orders,id',
            'inspection' => 'required|exists:arrival_inspections,id',
            'gate_pass' => 'required|exists:arrival_gate_passes,id',
            'weighbridge_id' => 'nullable|exists:arrival_weighbridges,id',
            'date' => 'required|date',
            'weighbridge_number' => 'required|string|max:255|unique:arrival_weighbridges,code',
            'cosec_no' => 'required|numeric',
            'location' => 'required|exists:weighbridges,id',
            'detail' => 'required|string',
            'no_of_pkg' => 'nullable|integer',
            'weight' => 'nullable|numeric',
            'goods_detail' => 'nullable|string',
        ]);

        $data = [
            'purchase_order_id' => $request->po,
            'arrival_inspection_id' => $request->inspection,
            'arrival_gate_pass_id' => $request->gate_pass,
            'weighbridge_id' => $request->weighbridge_id ?? null,
            'status' => $request->status ?? 1,
            'count' => $request->count ?? 1,
            'date' => $request->date ?? now()->format('Y-m-d'),
            'code' => $request->weighbridge_number,
            'cosec_no' => $request->cosec_no,
            'weighbridge_id' => $request->location,
            'detail' => $request->detail,
            'no_of_pkg' => $request->no_of_pkg,
            'weight' => $request->weight ?? $request->consignee_weight,
            'goods_detail' => $request->goods_detail,
            'user_id' => Auth::id()
        ];

       ArrivalWeighbridge::create($data);

        return redirect()->route('first-weighbridge.index')->with('success', 'Record created successfully');
    }

    public function show(ArrivalWeighbridge $ArrivalWeighbridge)
    {
    }

    public function edit(ArrivalWeighbridge $ArrivalWeighbridge)
    {
    }

    public function update(Request $request, ArrivalWeighbridge $ArrivalWeighbridge)
    {
    }

    public function destroy(ArrivalWeighbridge $ArrivalWeighbridge)
    {
    }
}
