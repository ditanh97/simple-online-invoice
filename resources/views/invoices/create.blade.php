@extends('layouts.app')

@section('title', 'Create New Invoice')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
        <form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="due_date">Due Date</label>
                        <input type="date" class="form-control" name="due_date">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" name="subject">
                    </div>
                </div>
                <div class="form-group" id="item-selection" style="display: none;">
                    
                    <div class="col-sm-2">
                        <label>Item</label>
                    </div>
                    <div class="col-sm-8">
                        <select name="item" id="item" class="form-control">
                            <option value="">-- Select Item --</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" id="add-item" class="btn btn-success add-item">Add Item</button>
                    </div>
                </div> 

                <div class="form-group" id="item-list" style="display: none;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Quantity Billed</th>
                                <th>Unit Price</th>
                                <th>Amount Billed</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="item-list-body">

                        </tbody>
                    </table>    
                </div>
                <div id="invoice-price" style="display: none;">
                    <div class="form-group">
                        <label for="subtotal">Subtotal</label>
                        <input readonly type="number" class="form-control" name="subtotal" id="subtotal" value=0>
                    </div>
                    <div class="form-group">
                        <label for="tax">Tax</label>
                        <input readonly type="number" class="form-control" name="tax" id="tax" value=0>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary ml-3" id="add-invoice" style="display: none;">Create Invoice</button>
            </div>
        </form>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            var itemList = []
            var total = null;


            $('#user_id').on('change', function() {
                var clientId = $(this).val();
                if (clientId) {
                    $.ajax({
                        url: '/api/items/' + clientId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            // hapus daftar item
                            console.log("halo rezpon", response);
                            // if (response.length > 0) {
                            //     $('#add-item').show();
                            //     itemList = response;
                            // }
                            $('#item-selection').show();
                            $('#item').empty();
                            $('#item').append('<option value="">Choose Item</option>');
                            $.each(response, function(index, item) {
                                $('#item').append('<option value="' + item.item_id + '">' +'('+ item.item_id+')'+ item.type + ' - ' +item.description + '</option>');
                            });
                            

    
                            // tampilkan daftar item yang tersedia
                            // $.each(response, function( 
                           
                        },
                        error: function(err) {
                            console.log(err);
                        }
    
                    });
                } else {
                    $('#item-form').hide();
                    $('#item-list').hide();
                    $('#item-selection').hide();
                    $('#add-item').hide();
                    $('#add-invoice').hide();
                }
            });
            $('#item').on('change', function() {
                var itemId = $(this).val();
                
                if(itemId) {
                    $('#add-item').show();
                } else {
                    $('#add-item').hide();
                }
            });
                // Ketika tombol "Add Item" ditekan
            $('#add-item').on('click', function(){
                $('#invoice-price').show();
                $('#item-list').show();
                var item_id = $('#item').val();
                if(item_id) {
                    // Mengambil data item berdasarkan ID
                    $.ajax({
                        url: '/api/item_detail/' + item_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response){
                            console.log("response satu:", response.type)
                            var item = {
                                ...response,
                                qty_billed: response.qty,
                                total_price: response.amount
                            };
                            itemList.push(item);
                            if (total == null) total = parseFloat(response.amount);
                            var html = '<tr>'+
                                    '<td><input readonly type="text" name="item_id[]" class="form-control item_id" value='+response.item_id+'></td>'+
                                    '<td><input readonly type="text" name="type[]" class="form-control type" value="'+response.type+'"></td>'+
                                    '<td><input readonly type="text" name="description[]" class="form-control description" value="'+response.description+'"></td>'+
                                    '<td><input readonly type="number" name="qty[]" class="form-control qty" value='+response.qty+'></td>'+
                                    '<td><input readonly type="number" name="qty_billed[]" min="1" class="form-control qty_billed" value='+response.qty+'></td>'+
                                    '<td><input readonly type="number" name="unit_price[]" class="form-control unit_price" value='+response.unit_price+'></td>'+
                                    '<td><input readonly type="number" name="total_price[]" class="form-control total_price" value='+response.amount+'></td>'+
                                    '<td><button type="button" class="btn btn-sm btn-danger remove_item">Hapus</button></td></tr>';
                            $('#item-list-body').append(html);
                        },
                        error: function(xhr, status, error){
                            var err = eval("(" + xhr.responseText + ")");
                            alert(err.Message);
                        }
                    });
    
                    updateSubTotalandTax();
                    $('#add-invoice').show();
                }
            });

            function updateSubTotalandTax() {
                $('input[name="total_price[]"]').each(function() {
                    var subtotal = parseInt($(this).val());
                    total += subtotal;
                });
                tax = total * 0.10
                $('#subtotal').val(total);
                $('#tax').val(tax);
            
            }


            // Ketika tombol "Hapus" di klik
            $(document).on('click', '.remove_item', function(){
                var itemId = $(this).data('item_id');
                itemList.splice(itemId - 1, 1);
                $(this).closest('tr').remove();
            });


            $('tr').on('change', function()  {
                // harus nya detect dulu remove baru berubah
                updateSubTotalandTax();
            })

            $('form').submit(function(event) {
                event.preventDefault();

                var user_id = $('#user_id').val();
                var due_date = $('#due_date').val();
                var subject = $('#subject').val();
                var subtotal = $('#subtotal').val();
                var tax = $('#tax').val();
                var cur_code = 'GBP';


                $.ajax({
                type: 'POST',
                url: "{{ route('invoices.store')}}",
                data: {
                    user_id,
                    due_date,
                    subject,
                    subtotal,
                    tax,
                    cur_code,
                    items: itemList
                },
                success: function(data) {
                    window.location.href = "{{ route('invoices.index') }}";
                }
                });
            });
        });
    </script>
@endsection

