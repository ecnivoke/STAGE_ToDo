<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'users_id'
    ];

    /**
     * Get the task records associated with the company.
     */
    public function Tasks()
    {
        return $this->hasMany(Tasks::class, 'lists_id');
    }
}
