<?php

namespace App\Http\Controllers;

use App\Models\ArrivalInspection;
use App\Models\ArrivalInspectionParam;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArrivalInspectionController extends Controller
{
    public function index(Request $request, $type)
    {
        $typeInt = getInspection('types', $type);
        $data = ArrivalInspection::where('count', $typeInt)
            ->with(['po', 'po.crop', 'po.cropCategory', 'po.cropItem', 'po.cropType', 'po.cropYear', 'po.supplier'])
            ->orderBy('id')
            ->paginate(10);

        return view("inspection.index", compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10)
            ->with('type', $type);
    }

    public function create($type)
    {
        $typeInt = getInspection('types', $type);
        $data = new \stdClass();
        // $data->po = PurchaseOrder::select('id', 'code')->where('count', 1)->where('status', 1)->get();
        $data->code = generateCode('inspection', 'INS-'.$typeInt);

        $purchaseOrder = PurchaseOrder::select('id', 'code');
        if($type == 'first') {
            $purchaseOrder = $purchaseOrder->whereDoesntHave('inspections', function ($q) {
                $q->where('status', 1);
                // ->orwhereIn('count', [1, 2, 3]);
            });
        }
        if($type == 'second') {
            $purchaseOrder = $purchaseOrder->whereDoesntHave('inspections', function ($q) {
                $q->where('count', 2)
                ->where('status', 1);
            })->whereHas('inspections', function ($q) {
                $q->where('count', 1)
                  ->where('status', 1);
            });
        }
        if($type == 'final') {
            $purchaseOrder = $purchaseOrder->whereDoesntHave('inspections', function ($q) {
                $q->where('count', 3)
                  ->where('status', 1);
            })->whereHas('inspections', function ($q) {
                $q->where('count', 2)
                  ->where('status', 1);
            });
        }
        $purchaseOrder = $purchaseOrder->get();
        $data->po = $purchaseOrder;

        // ->when($type == 'first', function ($query) {
        //     $query->whereHas('inspections', function ($q) { // whereDoesntHave
        //         $q->whereNull('arrival_inspection_id');
        //         $q->where('status', 1);
        //         $q->whereIn('count', [1, 2, 3]);
        //     });
        // })
        // ->when($type == 'second', function ($query) {
        //     $query->whereDoesntHave('inspections', function ($q) {
        //         $q->whereNotNull('arrival_inspection_id');
        //         // $q->where('status', 1);
        //         // $q->whereIn('count', [2, 3]);
        //     });
        // })
        // // ->when($type == 'second', function ($query) {
        // //     $query->whereDoesntHave('inspections', function ($q) {
        // //         $q->where('status', 1)
        // //           ->whereNotIn('count', [2, 3]);
        // //     });
        // // })
        // ->when($type == 'final', function ($query) {
        //     $query->whereDoesntHave('inspections', function ($q) {
        //         $q->where('status', 1)
        //           ->where('count', 3);
        //     });
        // })

        // if($type == 'second') {
        //     $data->arrivalInsp = ArrivalInspection::where('count', $typeInt)->select('id', 'code', 'count')->get();
        // }
        // dd($data);
        return view("inspection.create", compact('data', 'type'));
    }

    public function store(Request $request, $type)
    {
        // Validation rules, could be adjusted based on the type if needed
        $this->validate($request, [
            'status' => 'required|in:1,2',
            'date' => 'required|date',
            'inspection_number' => 'required|string|max:255|unique:arrival_inspections,code',
            'arrival_inspection_id' => 'nullable|exists:arrival_inspections,id',
            'po' => 'required|exists:purchase_orders,id',
            'jute_bags' => 'required|integer',
            'consignee_weight' => 'required|numeric',
            'bilty_no' => 'required|string',
            'bilty_date' => 'required|date',
            'transporter_name' => 'required|string',
            'vechile_number' => 'required|string',
            'driver_name' => 'required|string',
            'driver_phone' => 'required|string',
            // 'driver_nic' => 'required|string',
            'detail' => 'nullable|string',
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
            'driver_nic' => $request->driver_nic ?? 0, // Assuming this can be nullable
            'attachement' => $request->attachement,
            'detail' => $request->detail,
            'user_id' => Auth::id(),
        ];

        $inspection = ArrivalInspection::create($data);
        $inspectionID = $inspection->id;

        // Assuming `params` and `rating` are passed from the request
        if ($request->has('params')) {
            foreach ($request->params as $key => $paramType) {
                if (isset($request->rating[$key])) {
                    ArrivalInspectionParam::create([
                        'arrival_inspection_id' => $inspectionID,
                        'type' => $paramType,
                        'value' => $request->rating[$key],
                    ]);
                }
            }
        }

        return redirect()->route('inspection.index', ['type' => $type])->with('success', 'Record created successfully');
    }


    // public function index(Request $request)
    // {
    //     $data = ArrivalInspection::where('count', 1)->with(['po', 'po.crop', 'po.cropCategory', 'po.cropItem', 'po.cropType', 'po.cropYear', 'po.supplier'])->orderBy('id')->paginate(10);

    //     return view('first_inspection.index',compact('data'))
    //         ->with('i', ($request->input('page', 1) - 1) * 10);
    // }
    // public function create()
    // {
    //     $data = json_decode('{}');
    //     $data->po = PurchaseOrder::get();
    //     $data->code = generateCode('inspection', 'INS');
    //     return view('first_inspection.create', compact('data'));
    // }

    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'status' => 'required|in:1,2',
    //         'date' => 'required|date',
    //         'inspection_number' => 'required|string|max:255|unique:arrival_inspections,code',
    //         'arrival_inspection_id' => 'nullable|exists:arrival_inspections,id',
    //         'po' => 'required|exists:purchase_orders,id',
    //         // 'bags_no' => 'required|integer',
    //         // 'pp_bags' => 'required|integer',
    //         'jute_bags' => 'required|integer',
    //         'consignee_weight' => 'required|numeric',
    //         'bilty_no' => 'required|string',
    //         'bilty_date' => 'required|date',
    //         'transporter_name' => 'required|string',
    //         // 'vechile_type' => 'required|integer',
    //         'vechile_number' => 'required|string',
    //         'driver_name' => 'required|string',
    //         'driver_phone' => 'required|string',
    //         // 'driver_nic' => 'required|string',
    //         'detail' => 'nullable|string',
    //         // 'user_id' => 'required|exists:users,id',
    //         'rating.*' => 'nullable|numeric',
    //     ]);

    //     $data = [
    //         'status' => $request->status,
    //         'purchase_order_id' => $request->po,
    //         'arrival_inspection_id' => $request->arrival_inspection_id,
    //         'count' => $request->count ?? 1,
    //         'date' => $request->date ?? now()->format('Y-m-d'),
    //         'code' => $request->inspection_number,
    //         'bags_no' => $request->bags_no ?? 0,
    //         'pp_bags' => $request->pp_bags ?? 0,
    //         'jute_bags' => $request->jute_bags,
    //         'consignee_weight' => $request->consignee_weight,
    //         'bilty_no' => $request->bilty_no,
    //         'bilty_date' => $request->bilty_date,
    //         'transporter_name' => $request->transporter_name,
    //         'vechile_type' => $request->vechile_type ?? 0,
    //         'vechile_number' => $request->vechile_number,
    //         'driver_name' => $request->driver_name,
    //         'driver_phone' => $request->driver_phone,
    //         'driver_nic' => $request->driver_nic ?? 0,
    //         'attachement' => $request->attachement,
    //         'detail' => $request->detail,
    //         'user_id' => Auth::id()
    //     ];

    //    $insepction = ArrivalInspection::create($data);

    //    $inspectionID = $insepction->id;

    //    foreach($request->params as $key => $type){
    //        if(isset($request->rating[$key])) {
    //             ArrivalInspectionParam::create([
    //                 'arrival_inspection_id' => $inspectionID,
    //                 'type' => $type,
    //                 'value' => $request->rating[$key],
    //             ]);
    //         }
    //    }

    //     return redirect()->route('purchase_order.index')->with('success', 'Record created successfully');
    // }

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
