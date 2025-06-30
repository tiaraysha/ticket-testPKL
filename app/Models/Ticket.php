<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $fillable = [
        'id',
        'name',
        'email',
        'title',
        'description',
        'ticket_type_id',
        'project_id',
        'assign_at',
        'status',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

