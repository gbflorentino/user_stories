<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
	'user_id',
	'category_id',
	'transaction_type',
	'amount'
    ];

    public function user()
    {
	return $this->belogsTo(User::class);
    }

    public function category()
    {
	return $this->belogsTo(Category::class);
    }
}
