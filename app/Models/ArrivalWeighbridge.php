<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArrivalWeighbridge extends Model
{
    use HasFactory;
    protected $guarded;

    public function pass()
    {
        return $this->belongsTo(ArrivalGatePass::class, 'arrival_gate_pass_id', 'id');
    }

    public function po()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id', 'id');
    }

    public function inspection()
    {
        return $this->belongsTo(ArrivalInspection::class, 'arrival_inspection_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Weighbridge::class, 'weighbridge_id', 'id');
    }
}
