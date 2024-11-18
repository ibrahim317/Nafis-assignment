<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
    ];
    protected $casts = [
        'due_date' => 'datetime:Y-m-d H:i:s',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
