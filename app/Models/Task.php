<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'frequency',
    ];

    public function completions(): HasMany {
        return $this->hasMany('App\Models\Completion');
    }

    public function user(): BelongsTo {
        return $this->belongsTo('App\Models\User');
    }
}
