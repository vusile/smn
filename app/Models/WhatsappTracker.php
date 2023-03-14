<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappTracker extends Model
{
    protected $fillable = ['phone', 'message', 'message_id', 'delivery_status', 'conversation_id', 'type'];
    protected $table = 'whatsapp_tracker';

}
