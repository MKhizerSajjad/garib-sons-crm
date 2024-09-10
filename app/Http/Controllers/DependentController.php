<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Item,
    Category,
    SupplierAgent,
};

class DependentController extends Controller
{
    public function getSubcategories(Request $request)
    {
        $categoryId = $request->input('category_id');
        $subcategories = Category::where('status', 1)
            ->where('category_id', $categoryId)
            ->get();

        return response()->json($subcategories);
    }

    public function getItems(Request $request)
    {
        $subCategoryId = $request->input('sub_category_id');
        $items = Item::where('status', 1)
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
}
