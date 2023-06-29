<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Module extends Model
{
    use HasFactory;

    public $fillable = ['name', 'product_id', 'visibility']; 
    /**
     * Return product of this module
     */
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Return screens of the module
     */
    public function screens() : HasMany
    {
        return $this->hasMany(Screen::class, 'module_id');
    }
}
