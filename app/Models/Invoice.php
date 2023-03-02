<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public $table = "tt_invoices";

    protected $primaryKey = 'invoice_id';
    protected $fillable = [
        'user_id',
        'issue_date',
        'due_date',
        'subject',
        'subtotal',
        'tax',
        'payment',
        'due_amount',
        'cur_code'
    ];
    // public function items()
    // {
    //     return $this->hasMany(InvoiceItem::class);
    // }
    public function items()
    {
        return $this->belongsToMany(Item::class, 'tt_invoice_item', 'invoice_id', 'item_id')
        ->withPivot(['qty_billed','total_price']);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
