<?php

namespace App\Http\Controllers;

use App\Models\CropItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CropItemController extends Controller
{
    public function index(Request $request)
    {
        $data = CropItem::orderBy('name')->paginate(10);

        return view('item.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('item.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'category_id' => 'required',
        ]);

        $data = [
            'status' => $request->status ?? 1,
            'name' => $request->name,
            'name' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'item_id' => $request->item_id,
            'detail' => $request->detail,
        ];

        CropItem::create($data);

        return redirect()->route('item.index')->with('success','Record created successfully');
    }

    public function show(CropItem $cropItem)
    {
        if (!empty($cropItem)) {

            $data = [
                'item' => $cropItem
            ];
            return view('item.show', $data);

        } else {
            return redirect()->route('item.index');
        }
    }

    public function edit(CropItem $cropItem)
    {
        return view('item.edit', compact('item'));
    }

    public function update(Request $request, CropItem $cropItem)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'category_id' => 'required',
        ]);

        $data = [
            'status' => isset($request->status) ? $request->status : $cropItem->status,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'item_id' => $request->item_id,
            'detail' => $request->detail,
        ];

        CropItem::find($cropItem->id)->update($data);

        return redirect()->route('item.index')->with('success','Updated successfully');
    }

    public function destroy(CropItem $cropItem)
    {
        CropItem::find($cropItem->id)->delete();
        return redirect()->route('item.index')->with('success', 'Deleted successfully');
    }
}
