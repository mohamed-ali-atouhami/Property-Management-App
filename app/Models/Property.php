<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'type',
        'units',
        'rental_cost'
    ];
    public function tenants() {
        return $this->hasMany(Tenant::class);
    }
    
}
