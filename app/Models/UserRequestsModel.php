<?php

namespace App\Models;

use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRequestsModel extends Model
{
    use HasFactory;

    protected $table = 'user_requests';

    protected $fillable = [
        'chat_id',
        'test_id',
    ];

    public function chat(): BelongsTo
    {
        return $this->belongsTo(TelegraphChat::class, 'chat_id', 'id');
    }
}
