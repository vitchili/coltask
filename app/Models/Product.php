<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    public $fillable = ['name', 'visibility'];
    /**
     * Return modules of the product
     */
    public function modules() : HasMany
    {
        return $this->hasMany(Module::class, 'product_id');
    }
}
