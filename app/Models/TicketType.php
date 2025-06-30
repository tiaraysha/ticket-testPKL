<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class TicketType extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $fillable = [
        'id', 'name'
    ];
    public $incrementing = false;
    protected $keyType = 'string';
    

    public const Insiden = 'Insiden';
    public const Perubahan_Permintaan = 'Perubahan_Permintaan';
    public const Penugasan = 'Penugasan';

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    
}
