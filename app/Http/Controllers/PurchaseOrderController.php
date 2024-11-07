<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Crop,
    CropItem,
    CropCategory,
    CropType,
    CropYear,
    PurchaseOrder,
    Supplier,
    Location
};

class PurchaseOrderController extends Controller
{
    public function index(Request $request)
    {
        $data = PurchaseOrder::with(['cropCategory', 'cropItem', 'cropType', 'cropYear', 'supplier'])->orderByDesc('dated')->paginate(10);

        return view('purchase_order.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $data = json_decode('{}');
        $data->poCode = generateCode('po', 'RO', null, 'short');
        $data->crops = Crop::where('status', 1)->get();
        // $data->crops = CropType::where('status', 1)->get();
        $data->years = CropYear::where('status', 1)->get();
        // $data->cats = CropCategory::where('status', 1)->get();
        // $data->subcats = Category::where('status', 1)->where('category_id', '!=', null)->get();
        // $data->items = Item::where('status', 1)->where('item_id', null)->get();
        // $data->subitems = Item::where('status', 1)->where('item_id', '!=', null)->orderBy('name')->get();
        $data->suppliers = Supplier::where('status', 1)->orderBy('name')->get();
        $data->locations = Location::where('status', 1)->orderBy('name')->get();
        return view('purchase_order.create', compact('data'));
    }

    public function create1()
    {
        $data = json_decode('{}');
        $data->poCode = generateCode('po', 'RO', null, 'short');
        $data->crops = Crop::where('status', 1)->get();
        // $data->crops = CropType::where('status', 1)->get();
        $data->years = CropYear::where('status', 1)->get();
        // $data->cats = CropCategory::where('status', 1)->get();
        // $data->subcats = Category::where('status', 1)->where('category_id', '!=', null)->get();
        // $data->items = Item::where('status', 1)->where('item_id', null)->get();
        // $data->subitems = Item::where('status', 1)->where('item_id', '!=', null)->orderBy('name')->get();
        $data->suppliers = Supplier::where('status', 1)->orderBy('name')->get();
        $data->locations = Location::where('status', 1)->orderBy('name')->get();
        return view('purchase_order.create1', compact('data'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $vals = explode('|', $request->item);
        // dd(($vals));
        $item = $vals[0];
        $cat = $vals[1];

        $validatedData = $request->validate([
            'status' => 'required|integer|in:1,2',
            'po_number' => 'required|string|max:255|unique:purchase_orders,code',
            'crop' => 'required|exists:crops,id',
            // 'crop_category_id' => 'required|exists:crop_categories,id',
            // 'item' => 'required|exists:crop_items,id',
            'item' => 'required',
            'type' => 'required|exists:crop_types,id',
            'year' => 'required|exists:crop_years,id',
            'note' => 'nullable|string|max:800',
            'supplier' => 'required|exists:suppliers,id',
            'agent' => 'nullable|exists:supplier_agents,id',
            'description' => 'nullable|string|max:1000',
            'po_date' => 'nullable|date',
            'start_date' => 'nullable|date',
            'delivery_date' => 'nullable|date',
            'location' => 'required|exists:locations,id',
            'min_delivery_mode' => 'required|integer',
            'min_qty' => 'required|integer',
            // 'max_delivery_mode' => 'required|integer',
            'max_qty' => 'required|integer',
            'delivery_term' => 'required|integer',
            'order_rate' => 'required|numeric|min:1',
            'kg_rate' => 'required|numeric|min:1',
            'brokery_term' => 'required|integer',
            'return_type' => 'required|integer',
            'freight_per_kg' => 'required|numeric|min:1',
            'commission_per_bag' => 'required|numeric|min:1',
            'bardana_per_bag' => 'required|numeric|min:1',
            'misc_exp_per_bag' => 'required|numeric|min:1',
            'moisture' => 'required|numeric|min:1',
            'damage' => 'required|numeric|min:1',
            'broken' => 'required|numeric|min:1',
            'chalkey' => 'required|numeric|min:1',
            'ov' => 'required|numeric|min:1',
            'chobba' => 'required|numeric|min:1',
            'look' => 'required|numeric|min:1',
            'weight_amount' => 'required|numeric|min:1',
            'landed_cost' => 'required|numeric|min:1',
            'payment_term' => 'required|integer',
            'created_by' => 'required|exists:users,id',
        ]);

        // Create a new PurchaseOrder instance and assign validated data
        $model = new PurchaseOrder();
        $model->status = $validatedData['status'];
        $model->code = $validatedData['po_number']; // Ensure 'code' column is used for po_number
        $model->crop_id = $validatedData['crop'];
        $model->crop_category_id = $cat;
        $model->crop_item_id = $item;
        $model->crop_type_id = $validatedData['type'];
        $model->crop_year_id = $validatedData['year'];
        $model->sub_item_id = $validatedData['sub_item'] ?? 1;
        $model->note = $validatedData['note'];
        $model->supplier_id = $validatedData['supplier'];
        $model->supplier_agent_id = $validatedData['agent']; // Assuming this maps to 'supplier_people_id'
        $model->description = $validatedData['description'];
        $model->dated = $validatedData['po_date'];
        $model->start_date = $validatedData['start_date'];
        $model->end_date = $validatedData['delivery_date'];
        $model->location_id = 1; //$validatedData['location'];
        $model->min_delivery_mode = $validatedData['min_delivery_mode'];
        $model->min_qty = $validatedData['min_qty'];
        $model->max_delivery_mode = $validatedData['min_delivery_mode'];
        $model->max_qty = $validatedData['max_qty'];
        $model->delivery_term = $validatedData['delivery_term'];
        $model->order_rate = $validatedData['order_rate'];
        $model->kg_rate = $validatedData['kg_rate'];
        $model->brokery_term = $validatedData['brokery_term'];
        $model->replacement = $validatedData['return_type'];
        $model->kg_freight = $validatedData['freight_per_kg'];
        $model->bag_commission = $validatedData['commission_per_bag'];
        $model->bag_bardana = $validatedData['bardana_per_bag'];
        $model->bag_misc = $validatedData['misc_exp_per_bag'];
        $model->moisture = $validatedData['moisture'];
        $model->damage = $validatedData['damage'];
        $model->broken = $validatedData['broken'];
        $model->chalky = $validatedData['chalkey'];
        $model->o_v = $validatedData['ov'];
        $model->chobba = $validatedData['chobba'];
        $model->look = $validatedData['look'];
        $model->weight_amount = $validatedData['weight_amount'];
        $model->total_amount = $validatedData['landed_cost'];
        $model->payment_term = $validatedData['payment_term'];
        $model->created_by = $validatedData['created_by'];

        // Save the model to the database
        $model->save();

        // $this->validate($request, [

        //     'status' => 'required|integer|in:1,2',
        //     'po_number' => 'required|string|max:255|unique:purchase_orders,code', // Adjust the table name
        //     'category' => 'required|exists:categories,id',
        //     'sub_category' => 'required|exists:categories,id',
        //     'item' => 'required|exists:items,id',
        //     'sub_item' => 'required|exists:items,id',
        //     'note' => 'nullable|string|max:500',
        //     'supplier' => 'required|exists:suppliers,id',
        //     'agent' => 'nullable|exists:supplier_agents,id', // Adjust this if agents table exists and is used
        //     'description' => 'nullable|string|max:1000',

        //     'po_date' => 'nullable|date',
        //     'start_date' => 'nullable|date',
        //     'end_date' => 'nullable|date',
        //     'location' => 'required|exists:locations,id',
        //     'min_delivery_mode' => 'required|integer',
        //     // 'min_qty' => 'required|numeric|min:1',
        //     'max_delivery_mode' => 'required|integer',
        //     // 'max_qty' => 'required|numeric|min:1',
        //     'delivery_term' => 'required|integer',
        //     'order_rate' => 'required|numeric|min:1',
        //     'kg_rate' => 'required|numeric|min:1',
        //     'brokery_term' => 'required|integer',
        //     'return_type' => 'required|integer',
        //     'kg_freight' => 'required|numeric|min:1',
        //     'bag_commission' => 'required|numeric|min:1',
        //     'bag_bardana' => 'required|numeric|min:1',
        //     'bag_misc' => 'required|numeric|min:1',
        //     'moisture' => 'required|numeric|min:1',
        //     'damage' => 'required|numeric|min:1',
        //     'chalky' => 'required|numeric|min:1',
        //     'o_v' => 'required|numeric|min:1',
        //     'chobba' => 'required|numeric|min:1',
        //     'look' => 'required|numeric|min:1',
        //     'weight_amount' => 'required|numeric|min:1',
        //     'total_amount' => 'required|numeric|min:1',
        //     'payment_term' => 'required|integer',
        //     'note' => 'nullable|string',
        //     'description' => 'nullable|string',
        //     'created_by' => 'required|exists:users,id',
        // ]);

        // $model = new PurchaseOrder();
        // $model->status = $request->input('status');
        // $model->code = $request->input('po_number'); // Ensure 'code' column is used for po_number
        // $model->category_id = $request->input('category');
        // $model->sub_category_id = $request->input('sub_category');
        // $model->item_id = $request->input('item');
        // $model->sub_item_id = $request->input('sub_item');
        // $model->note = $request->input('note');
        // $model->supplier_id = $request->input('supplier');
        // $model->supplier_people_id = $request->input('agent'); // Assuming this maps to 'supplier_people_id'
        // $model->description = $request->input('description');
        // $model->dated = $request->input('po_date');
        // $model->start_date = $request->input('start_date');
        // $model->end_date = $request->input('end_date');
        // $model->location_id = $request->input('location');
        // $model->min_delivery_mode = $request->input('min_delivery_mode');
        // $model->min_qty = 1;
        // $model->max_delivery_mode = $request->input('max_delivery_mode');
        // $model->max_qty = 1;
        // $model->delivery_term = $request->input('delivery_term');
        // $model->order_rate = $request->input('order_rate');
        // $model->save();

        // PurchaseOrder::create($validatedData);

        return redirect()->route('purchaseorder.index')->with('success','Record created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }
}
