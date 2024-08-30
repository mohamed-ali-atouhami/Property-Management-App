<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'name',
        'phone',
        'email',
        'property_id',
        'section'
    ];
    public function property() {
        return $this->belongsTo(Property::class);
    }
    
    public function payments() {
        return $this->hasMany(Payment::class);
    }
    
}
