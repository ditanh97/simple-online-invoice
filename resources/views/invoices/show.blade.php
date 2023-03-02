@extends('layouts.app')
  
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Invoices</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('invoices.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Client: </strong>
                {{ $invoice->client->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Invoice Number: </strong>
                {{ $invoice->invoice_id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Invoice Subject: </strong>
                {{ $invoice->subject }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Issue Date: </strong>
                {{ $invoice->issue_date }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Due Date: </strong>
                {{ $invoice->due_date }}
            </div>
        </div>
        <table class="table table-bordered">
            <tr>
                <th>Type</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Amount</th>

            </tr>
            @foreach ($invoice->items as $item)
            <tr>
                <td>{{ $item->type }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->pivot->qty_billed }}</td>
                <td>{{ $item->unit_price }}</td>
                <td>{{ $item->pivot->total_price }}</td>
            </tr>
            @endforeach
        </table>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Subtotal: </strong>
                {{ $invoice->subtotal }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tax(10%): </strong>
                {{ $invoice->tax }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Payments: </strong>
                {{ $invoice->payment }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Due Amount: </strong>
                {{ $invoice->due_amount }}
            </div>
        </div>
    </div>
@endsection