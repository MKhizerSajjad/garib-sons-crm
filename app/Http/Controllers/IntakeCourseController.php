<?php

namespace App\Http\Controllers;

use App\Models\IntakeCourse;
use App\Models\University;
use App\Models\Course;
use Illuminate\Http\Request;

class IntakeCourseController extends Controller
{
    public function index(Request $request)
    {
        $data = IntakeCourse::with('materials')->orderByDesc('code')->paginate(10);
        return view('intake.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $Universities = University::orderBy('name')->where('status', 1)->get();
        $courses = Course::orderBy('name')->where('status', 1)->get();
        return view('intake.create', compact('Universities', 'courses'));
    }

    public function store(Request $request)
    {
        dd('adadsss');
        $this->validate($request, [
            'date' => 'required',
        ]);

        $code = $this->generateInvoiceCode();

        $data = [
            'delivery' => $request->delivery ?? 1,
            'payment' => $request->payment ?? 1,
            'date' => $request->date,
            'code' => $code,
            'price' => $request->total_price,
            'detail' => $request->detail,
        ];

        $purchase = IntakeCourse::create($data);

        $purchaseId = $purchase->id;

        for($i=0; $i<count($request->material); $i++) {
            if(isset($request->material[$i]) && isset($request->quantity[$i]) && isset($request->unit_price[$i])) {
                $data = [
                    'purchase_id' => $purchaseId,
                    'material_id' => $request->material[$i],
                    'qty' => $request->quantity[$i],
                    'unit_price' => $request->unit_price[$i],
                ];
                PurchaseMaterial::create($data);
            }
        }

        if(isset($request->lorry)) {
            for($i=0; $i<count($request->lorry); $i++) {
                if(isset($request->lorry[$i])) { // && isset($request->ship_quantity[$i])
                    $data = [
                        'status' => 1,
                        'purchase_id' => $purchaseId,
                        'lorry_id' => $request->lorry[$i],
                        'qty' => 0, //$request->ship_quantity[$i],
                    ];
                    PurchaseDelivery::create($data);
                }
            }
        }

        return redirect()->route('intake.index')->with('success','Record created successfully');
    }

    public function show(Purchase $purchase)
    {
        if (!empty($purchase)) {

            $data = [
                'purchase' => $purchase
            ];
            return view('intake.show', $data);

        } else {
            return redirect()->route('intake.index');
        }
    }

    public function edit(Purchase $purchase)
    {
        $lorries = Lorry::orderBy('plate_number')->where('status', 1)->get();
        return view('intake.edit', compact('purchase', 'lorries'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $this->validate($request, [
            'date' => 'required',
        ]);

        $purchaseId = $purchase->id;
        $data = [
            'delivery' => $request->delivery ?? 1,
            'payment' => $request->payment ?? 1,
            'date' => $request->date,
            'price' => $request->total_price,
            'detail' => $request->detail,
        ];

        IntakeCourse::find($purchaseId)->update($data);

        PurchaseMaterial::where('purchase_id', $purchaseId)->delete();
        for ($i = 0; $i < count($request->material); $i++) {
            if (isset($request->material[$i]) && isset($request->quantity[$i]) && isset($request->unit_price[$i])) {
                PurchaseMaterial::updateOrCreate(
                    [
                        'purchase_id' => $purchaseId,
                        'material_id' => $request->material[$i],
                    ],
                    [
                        'qty' => $request->quantity[$i],
                        'unit_price' => $request->unit_price[$i],
                    ]
                );
            }
        }

        PurchaseDelivery::where('purchase_id', $purchaseId)->delete();

        if(isset($request->lorry)) {
            for($i=0; $i<count($request->lorry); $i++) {
                if(isset($request->lorry[$i]) && isset($request->ship_quantity[$i])) {
                    $data = [
                        'status' => 1,
                        'purchase_id' => $purchaseId,
                        'lorry_id' => $request->lorry[$i],
                        'qty' => 0, //$request->ship_quantity[$i],
                    ];
                    PurchaseDelivery::create($data);
                }
            }
        }

        return redirect()->route('intake.index')->with('success','Updated successfully');
    }

    public function destroy(Purchase $purchase)
    {
        IntakeCourse::find($purchase->id)->delete();
        return redirect()->route('intake.index')->with('success', 'Deleted successfully');
    }

    public function generateInvoiceCode() {
        $code = Carbon::now()->format('Ymd');
        $todaysCount = IntakeCourse::where('code', 'LIKE', $code.'%')->count();
        // Increment the max code number by 1, if null set it to 1
        return $code. str_pad(++$todaysCount, 5, '0', STR_PAD_LEFT);
    }
}
