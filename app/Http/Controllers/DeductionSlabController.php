<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\CropYear;
use App\Models\DeductionSlab;
use App\Models\DeductionSlabDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DeductionSlabController extends Controller
{
    public function index(Request $request)
    {
        $data = DeductionSlab::with(['crop', 'cat', 'cropType','year'])->orderBy('type')->paginate(10);

        return view('deduction_slab.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $data = json_decode('{}');
        $data->crops = Crop::where('status', 1)->get();
        $data->years = CropYear::where('status', 1)->get();
        return view('deduction_slab.create', compact('data'));
    }

    public function store(Request $request)
    {
        $vals = explode('|', $request->item);
        $item = $vals[0];
        $cat = $vals[1];

        $this->validate($request, [
            'status' => 'required',
            'deduction_type' => 'required',
            'crop' => 'required',
            'item' => 'required',
            'crop_type' => 'required',
            'year' => 'required',
            'from' => 'required|array',
            'from.*' => 'required|string',
            'to' => 'required|array',
            'to.*' => 'required|string',
            'deduction' => 'required|array',
            'deduction.*' => 'required|string',
            // 'remarks' => 'required|array',
            // 'remarks.*' => 'required|string',

            // Add a custom rule for uniqueness
            // 'recrod_already_exist_unique' => [
            //     'required',
            //     \Illuminate\Validation\Rule::unique('deduction_slabs')->where(function ($query) use ($request, $item, $cat) {
            //         return $query->where('status', $request->input('status'))
            //                     ->where('type', $request->input('deduction_type'))
            //                     ->where('crop_id', $request->input('crop'))
            //                     ->where('crop_category_id', $cat)
            //                     ->where('crop_item_id', $item)
            //                     ->where('crop_type', $request->input('crop_type'))
            //                     ->where('year', $request->input('year'));
            //     }),
            // ]
            // , [
            //     'unique_record.required' => 'A record with the same details already exists.',
            // ],
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'type' => $request->deduction_type,
            'crop_id' => $request->crop,
            'crop_category_id' => $cat,
            'crop_item_id' => $item,
            'crop_type_id' => $request->crop_type,
            'crop_year_id' => $request->year,
            'detail' => $request->detail,
        ];
        $slab = DeductionSlab::create($data);

        foreach( $request->from as $key => $value ) {
            $data = [
                'deduction_slab_id' => $slab->id,
                'from' => $request->from[$key],
                'to' => $request->to[$key],
                'deduction' => $request->deduction[$key],
                'remarks' => $request->remarks[$key],
            ];
            DeductionSlabDetail::create($data);
        }

        return redirect()->route('slab.index')->with('success','Record created successfully');
    }

    public function show(DeductionSlab $deductionSlab)
    {
        if (!empty($deductionSlab)) {

            $data = [
                'item' => $deductionSlab
            ];
            return view('slab.show', $data);

        } else {
            return redirect()->route('slab.index');
        }
    }

    public function edit(DeductionSlab $deductionSlab)
    {
        return view('deduction_slab.edit', compact('item'));
    }

    public function update(Request $request, DeductionSlab $deductionSlab)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'category_id' => 'required',
        ]);

        $data = [
            'status' => isset($request->status) ? $request->status : $deductionSlab->status,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'item_id' => $request->item_id,
            'detail' => $request->detail,
        ];

        DeductionSlab::find($deductionSlab->id)->update($data);

        return redirect()->route('deduction_slab.index')->with('success','Updated successfully');
    }

    public function destroy(DeductionSlab $deductionSlab)
    {
        DeductionSlab::find($deductionSlab->id)->delete();
        return redirect()->route('deduction_slab.index')->with('success', 'Deleted successfully');
    }
}
