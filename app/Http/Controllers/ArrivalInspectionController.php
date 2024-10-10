<?php

namespace App\Http\Controllers;

use App\Models\ArrivalInspection;
use App\Models\ArrivalInspectionParam;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArrivalInspectionController extends Controller
{
    public function index(Request $request)
    {
        $data = ArrivalInspection::where('count', 1)->with(['po', 'po.crop', 'po.cropCategory', 'po.cropItem', 'po.cropType', 'po.cropYear', 'po.supplier'])->orderBy('id')->paginate(10);

        return view('first_inspection.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
    public function create()
    {
        $data = json_decode('{}');
        $data->po = PurchaseOrder::get();
        $data->code = generateCode('inspection', 'INS');
        return view('first_inspection.create', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:1,2',
            'date' => 'required|date',
            'inspection_number' => 'required|string|max:255|unique:arrival_inspections,code',
            'arrival_inspection_id' => 'nullable|exists:arrival_inspections,id',
            'po' => 'required|exists:purchase_orders,id',
            // 'bags_no' => 'required|integer',
            // 'pp_bags' => 'required|integer',
            'jute_bags' => 'required|integer',
            'consignee_weight' => 'required|numeric',
            'bilty_no' => 'required|string',
            'bilty_date' => 'required|date',
            'transporter_name' => 'required|string',
            // 'vechile_type' => 'required|integer',
            'vechile_number' => 'required|string',
            'driver_name' => 'required|string',
            'driver_phone' => 'required|string',
            // 'driver_nic' => 'required|string',
            'detail' => 'nullable|string',
            // 'user_id' => 'required|exists:users,id',
            'rating.*' => 'nullable|numeric',
        ]);

        $data = [
            'status' => $request->status,
            'purchase_order_id' => $request->po,
            'arrival_inspection_id' => $request->arrival_inspection_id,
            'count' => $request->count ?? 1,
            'date' => $request->date ?? now()->format('Y-m-d'),
            'code' => $request->inspection_number,
            'bags_no' => $request->bags_no ?? 0,
            'pp_bags' => $request->pp_bags ?? 0,
            'jute_bags' => $request->jute_bags,
            'consignee_weight' => $request->consignee_weight,
            'bilty_no' => $request->bilty_no,
            'bilty_date' => $request->bilty_date,
            'transporter_name' => $request->transporter_name,
            'vechile_type' => $request->vechile_type ?? 0,
            'vechile_number' => $request->vechile_number,
            'driver_name' => $request->driver_name,
            'driver_phone' => $request->driver_phone,
            'driver_nic' => $request->driver_nic ?? 0,
            'attachement' => $request->attachement,
            'detail' => $request->detail,
            'user_id' => Auth::id()
        ];

       $insepction = ArrivalInspection::create($data);

       $inspectionID = $insepction->id;

       foreach($request->params as $key => $type){
           if(isset($request->rating[$key])) {
                ArrivalInspectionParam::create([
                    'arrival_inspection_id' => $inspectionID,
                    'type' => $type,
                    'value' => $request->rating[$key],
                ]);
            }
       }

        return redirect()->route('purchase_order.index')->with('success', 'Record created successfully');
    }

    public function show(ArrivalInspection $arrivalInspection)
    {
        //
    }

    public function edit(ArrivalInspection $arrivalInspection)
    {
        //
    }

    public function update(Request $request, ArrivalInspection $arrivalInspection)
    {
        //
    }

    public function destroy(ArrivalInspection $arrivalInspection)
    {
        //
    }
}
