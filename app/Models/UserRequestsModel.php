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
        'user_id',
        'chat_id',
        'bejik_id',
    ];

    public function chat(): BelongsTo
    {
        return $this->belongsTo(TelegraphChat::class, 'chat_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
