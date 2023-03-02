<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvoiceStatus;
use App\Models\User;
use App\Models\Item;
use App\Models\Invoice;
use App\Models\InvoiceItem;


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
            'user_id' => 'required',
            'issue_date' => 'required',
            'subtotal' => 'required',
            'tax' => 'required',
            'items.*.item_id' => 'required',
            'items.*.total_price' => 'required',
            'items.*.qty_billed' => 'required',
        ]);

        $input = $request->all();
        // Simpan data invoice
        $invoice = new Invoice;
        $invoice->user_id = $input['user_id'];
        $invoice->due_date = $input['due_date'];
        $invoice->subject = $input['subject'];
        $invoice->subtotal = $input['subtotal'];
        $invoice->tax = $input['tax'];
        $invoice->cur_code = $input['cur_code'];
        $invoice->save();
      
        // Simpan data item di invoice detail
        foreach ($input['items'] as $item) {
            $invoice_items = Item::find($item['item_id']);

            $invoiceItem = new InvoiceItem();
            $invoiceItem->invoice_id = $invoice->invoice_id;
            $invoiceItem->item_id = $invoice_items->item_id;
            $invoiceItem->qty_billed = $item['qty_billed'];
            $invoiceItem->unit_price = $invoice_items->unit_price;
            $invoiceItem->total_price = $item['total_price'];
            $invoice->cur_code = $invoice_items->cur_code;
            $invoiceItem->save();

            // Update quantity di table products
            // $invoice_items->quantity -= $item['quantity'];
            // $invoice_items->save();
        }
       
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
