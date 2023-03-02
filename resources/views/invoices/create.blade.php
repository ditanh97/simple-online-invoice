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
                        <label for="issue_date">Issue Date</label>
                        <input type="date" class="form-control" name="issue_date">
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
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="subtotal">Subtotal</label>
                        <input readonly type="number" class="form-control" name="subtotal" value=0>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="tax">Tax</label>
                        <input readonly type="number" class="form-control" name="tax" value=0>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary ml-3" id="add-invoice" style="display: none;">Create Invoice</button>
            </div>
        </form>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            itemData = []


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
                            //     itemData = response;
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
                console.log("tesss")
                $('#item-list').show();
                var item_id = $('#item').val();
                // Mengambil data item berdasarkan ID
                $.ajax({
                    url: '/api/item_detail/' + item_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response){
                        console.log("response satu:", response.type)
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
                // var opt  = itemData.reduce( (acc, obj) => {
                //     return acc + '<option value=' +  obj.item_id +'>'+obj.item_id+'</option>'
                // }, '')

                // var html = '<tr>'+
                //                 '<td><select name="item_id[]" class="form-control item_id"><option value="">Choose Item</option>'+opt +'</select></td>'+
                //                 // '<td class="types"></td>'+
                //                 '<td><input readonly type="text" name="type[]" class="form-control types"></td>'+
                //                 '<td><input readonly type="text" name="description[]" class="form-control description"></td>'+
                //                 '<td><input readonly type="number" name="qty[]" class="form-control qty"></td>'+
                //                 '<td><input type="number" name="qty_billed[]" min="1" class="form-control qty_billed"></td>'+
                //                 '<td><input readonly type="number" name="unit_price[]" class="form-control unit_price"></td>'+
                //                 '<td><input type="number" name="total_price[]" class="form-control total_price"></td>'+
                //                 '<td><button type="button" class="btn btn-sm btn-danger remove_item">Hapus</button></td></tr>';
                // $('#item-list-body').append(html);

                // // Ketika pilihan item berubah
                // $('select.item_id').on('change', function(){
                //     var item_id = $(this).val(); // Ambil value dari select item

                //     // Mengambil data item berdasarkan ID
                //     $.ajax({
                //         url: '/api/item_detail/' + item_id,
                //         type: 'GET',
                //         dataType: 'json',
                //         success: function(response){
                //             console.log("response satu:", response.type)
                //             $(this).closest('td').next().find('.types').val(response.type); 
                //             console.log("heeii", $(this).closest('td').next().find('.types').val());
                //             $(this).closest('tr').find('input.description').val(response.description);
                //             $(this).closest('tr').find('input.qty').val(response.qty);
                //             $(this).closest('tr').find('input.qty_billed').attr('max', response.qty); // Set value jumlah maksimum item
                //             $(this).closest('tr').find('input.unit_price').val(response.unit_price);
                //             $(this).closest('tr').find('input.total_price').attr('max', response.amount);
                //         },
                //         error: function(xhr, status, error){
                //             var err = eval("(" + xhr.responseText + ")");
                //             alert(err.Message);
                //         }
                //     });
                // });
                $('#add-invoice').show();
            });

            function calculateTotalAndTax() {
                
            }


            // Ketika tombol "Hapus" di klik
            $(document).on('click', '.remove_item', function(){

                $(this).closest('tr').remove();

            });
        });
    </script>
@endsection



<!--                                                             <td><input type="number" name="jumlah[]" id="jumlah"></td>
                        <td><input type="number" name="harga[]" id="harga"></td> -->