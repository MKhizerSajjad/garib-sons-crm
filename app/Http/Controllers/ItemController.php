<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $data = Item::orderBy('name')->paginate(10);

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

        Item::create($data);

        return redirect()->route('item.index')->with('success','Record created successfully');
    }

    public function show(Item $item)
    {
        if (!empty($item)) {

            $data = [
                'item' => $item
            ];
            return view('item.show', $data);

        } else {
            return redirect()->route('item.index');
        }
    }

    public function edit(Item $item)
    {
        return view('item.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'category_id' => 'required',
        ]);

        $data = [
            'status' => isset($request->status) ? $request->status : $item->status,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'item_id' => $request->item_id,
            'detail' => $request->detail,
        ];

        Item::find($item->id)->update($data);

        return redirect()->route('item.index')->with('success','Updated successfully');
    }

    public function destroy(Item $item)
    {
        Item::find($item->id)->delete();
        return redirect()->route('item.index')->with('success', 'Deleted successfully');
    }
}
