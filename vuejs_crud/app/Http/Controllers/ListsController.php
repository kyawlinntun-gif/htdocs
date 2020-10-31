<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class ListsController extends Controller
{

    public function index()
    {
        $items = Item::all();
        return response(
           $items
        );
    }

    public function store(Request $request)
    {
        // Insert item
        $item = new Item();
        $item->name = ucwords($request->name);
        $item->age = $request->age;
        $item->profession = ucwords($request->profession);
        $item->save();

        return response([]);
    }

    public function destroy(Request $request)
    {
        Item::find($request->item['id'])->delete();
        return response(['success' => 'Delete successfully!']);
    }

    public function update(Request $request)
    {
        $requestItem = [];
        array_push($requestItem, 'id', $request->editItems['id']);
        array_push($requestItem, 'name', $request->editItems['name']);

        $validator = Validator::make($requestItem->all(), {

        });

        // $item = Item::find($request->editItems['id']);
        // $item->name = $request->editItems['name'];
        // $item->age = $request->editItems['age'];
        // $item->profession = $request->editItems['profession'];
        // $item->update();

        return response([$requestItem]);
    }
}
