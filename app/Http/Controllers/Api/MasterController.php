<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InvoiceStatus;
use App\Models\Role;
use App\Models\Item;

class MasterController extends Controller
{
    public function get_invoice_status()
    {
        $users = InvoiceStatus::all();

        return response()->json($users);
    }
    public function get_roles()
    {
        $users = Role::all();

        return response()->json($users);
    }
    public function get_items($user_id)
    {
        $item = Item::where('user_id',$user_id)->where('is_paid', 0)->get();

        if (!$item) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($item);
    }

    public function get_item_detail($item_id)
    {
        $item = Item::find($item_id);

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        return response()->json($item);
    }
}
