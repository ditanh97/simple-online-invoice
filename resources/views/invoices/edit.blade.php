@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
        <form action="{{ route('invoice.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="user_id">Client:</strong>
                        <select class="form-control" name="user_id" id="user_id">
                            <option value="">--Select Client</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->user_id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="issue_date">Issue Date</label>
                        <input type="date" class="form-control" name="issue_date">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control" name="item_id[]">
                                        @foreach ($items as $item)
                                            <option value="{{ $item->item_id }}">{{ $item->description }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>    
                </div>
                <button type="submit" class="btn btn-primary ml-3">Save</button>
            </div>
        </form>
        </div>
    </div>
@endsection