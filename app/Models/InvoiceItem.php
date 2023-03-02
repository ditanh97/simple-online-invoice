<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;
    public $table = "tt_invoice_item";

    protected $primaryKey = 'id';
    protected $fillable = [
        'invoice_id',
        'item_id',
        'qty_billed',
        'unit_price',
        'total_price',
        'created_at',
        'updated_at',
        'cur_code'
    ];
    // public function invoice()
    // {
    //     return $this->belongsToMany(Invoice::class);
    // }
    // public function detail()
    // {
    //     return $this->belongsTo(Invoice::class, 'item_id');
    // }

}
