<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'tenant_id',
        'date_paid',
        'status',
        'due_date',
    ];
    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }
    
}
