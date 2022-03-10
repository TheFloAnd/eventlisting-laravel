<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Events extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'not_applicable',
        'event',
        'team',
        'start',
        'end',
        'repeat',
        'repeat_parent',
        'room',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function scopeEvents($query)
    {
        return $query->whereDate('start', '>=', date("Y-m-d"))
            ->whereNull('deleted_at')
            ->orderBy('start');
    }

    public function scopeOrder($query)
    {
        return $query
            ->whereNull('deleted_at')
            ->orderBy('start', 'ASC')
            ->orderBy('id', 'ASC');
    }

    public function scopeFollowing($query, $parent_id)
    {
        return $query
            ->where('repeat_parent', $parent_id)
            ->whereNull('deleted_at')
            ->orderBy('start', 'ASC')
            ->orderBy('id', 'ASC');
    }

    public function scopeProposals($query)
    {
        return $query->select('event', DB::raw('COUNT(`event`) as count'))
            ->whereNull('deleted_at')
            ->groupBy('event')
            ->orderBy('count', 'DESC')
            ->inRandomOrder();
    }

    public function scopeProposal_room($query)
    {
        return $query->select('room', DB::raw('COUNT(`room`) as count'))
            ->whereNull('deleted_at')
            ->groupBy('room')
            ->orderBy('count', 'DESC')
            ->inRandomOrder();
    }
}
