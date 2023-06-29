<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Screen extends Model
{
    
    use HasFactory;

    public $fillable = ['name', 'module_id'];

    /**
     * Return module of this screen
     */
    public function module() : BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

}
