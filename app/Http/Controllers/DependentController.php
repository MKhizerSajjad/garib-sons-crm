<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    ArrivalInspection,
    ArrivalGatePass,
    CropItem,
    CropType,
    CropCategory,
    SupplierAgent,
    PurchaseOrder
};

class DependentController extends Controller
{
    public function getCropItems(Request $request)
    {
        $crop = $request->input('crop_id');
        $cats = CropItem::with('cat:id,name')
            ->select('id', 'name', 'crop_category_id')
            ->where('status', 1)
            ->where('crop_id', $crop)
            ->get();

        return response()->json($cats);
    }

    public function getCropTypes(Request $request)
    {
        $crop = $request->input('crop_id');
        $types = CropType::select('id', 'name')
            ->where('status', 1)
            ->where('crop_id', $crop)
            ->get();

        return response()->json($types);
    }

    public function getSubcategories(Request $request)
    {
        $categoryId = $request->input('category_id');
        $subcategories = CropCategory::where('status', 1)
            ->where('category_id', $categoryId)
            ->get();

        return response()->json($subcategories);
    }

    public function getItems(Request $request)
    {
        $subCategoryId = $request->input('sub_category_id');
        $items = CropItem::where('status', 1)
            ->where('item_id', null)
            ->where('sub_category_id', $subCategoryId)
            ->get();

        return response()->json($items);
    }

    public function getSubitems(Request $request)
    {
        $itemId = $request->input('item_id');
        $subitems = Item::where('status', 1)
            ->where('item_id', '!=', null)
            // ->where('item_id', $itemId)
            ->orderBy('name')
            ->get();

        return response()->json($subitems);
    }

    public function getAgents(Request $request)
    {
        $supplierId = $request->input('supplier_id');
        $agents = SupplierAgent::where('status', 1)
            ->where('supplier_id', $supplierId)
            ->get();

        return response()->json($agents);
    }

    public function getPO(Request $request)
    {
        $poId = $request->input('po_id');
        $po = PurchaseOrder::with(['cropCategory:id,name', 'cropItem:id,name', 'cropType:id,name', 'cropYear:id,name', 'supplier:id,name'])
            ->where('id', $poId)
            ->select('id', 'crop_id', 'crop_category_id', 'crop_item_id', 'crop_type_id', 'crop_year_id', 'supplier_id', 'moisture', 'broken', 'damage', 'chalky', 'o_v', 'chobba', 'look', 'min_delivery_mode', 'min_qty', )
            ->first();

        return response()->json($po);
    }

    public function getInspections(Request $request)
    {
        $poId = $request->input('po_id');
        $po = ArrivalInspection::where('id', $poId)
            ->where('status', 1)
            ->select('id', 'code', 'purchase_order_id')
            ->get();

        return response()->json($po);
    }

    public function getInspectionDetails(Request $request)
    {
        $insId = $request->input('inspection_id');
        $details = ArrivalInspection::where('id', $insId)
            ->where('status', 1)
            ->first();

        return response()->json($details);
    }

    public function getGatePasses(Request $request)
    {
        $insId = $request->input('inspection_id');
        $passes = ArrivalGatePass::where('arrival_inspection_id', $insId)
            ->where('count', 1)
            ->get();

        return response()->json($passes);
    }
}
