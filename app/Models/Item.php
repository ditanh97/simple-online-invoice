<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public $table = "m_items";

    protected $primaryKey = 'item_id';
    protected $fillable = [
        'user_id',
        'type',
        'description',
        'qty',
        'unit_price',
        'amount',
        'cur_code',
        'is_paid'
    ];
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'tt_invoice_item', 'item_id', 'invoice_id');
    }
    // public function client()
    // {
    //     return $this->belongsTo(User::class);
    // }
    
    // public function invoice_item()
    // {
    //     return $this->hasMany(InvoiceItem::class);
    // }
}
