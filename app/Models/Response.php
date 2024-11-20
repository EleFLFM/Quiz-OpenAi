<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'test_id',
        'user_id',
        'question',
        'answer',
        'score',
        'feedback',
    ];

    /**
     * Get the test associated with the response.
     */
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    /**
     * Get the user who submitted the response.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
