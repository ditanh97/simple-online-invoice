@extends('layouts.app')

@section('title', 'All Invoice')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Invoice Database</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('invoices.create') }}"> Create New Invoices</a>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>Invoice Number</th>
            <th>Customer</th>
            <th>Subject</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($invoices as $invoice)
        <tr>
            <td>{{ $invoice->invoice_id }}</td>
            <td>{{ $invoice->client->name }}</td>
            <td>{{ $invoice->subject }}</td>
            <td>
   
                    <a class="btn btn-info" href="{{ route('invoices.show',$invoice->invoice_id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('invoices.edit',$invoice->invoice_id) }}">Edit</a>
   
            </td>
        </tr>
        @endforeach
    </table>
@endsection