<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvoiceStatus;
use App\Models\User;
use App\Models\Item;
use App\Models\Invoice;


class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.index',compact('invoices'));
    }
    public function create()
    {

        $clients = User::where('role_id', 2)->get();
        // $items = $client->items()->get();
        return view('invoices.create', compact('clients'));
    }

    public function show(Invoice $invoice)
    {
        return view('invoices.show',compact('invoice'));
    }

    public function save_invoice(Request $request)
    {
        $users = InvoiceStatus::all();

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
      
        Invoice::create($request->all());
       
        return redirect()->route('invoices.index')
                        ->with('success','Product created successfully.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
        $invoice->delete();
       
        return redirect()->route('invoices.index')
                        ->with('success','Invoice deleted successfully');
    }
}
