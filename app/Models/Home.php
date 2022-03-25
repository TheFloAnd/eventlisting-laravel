<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\DB;

class home extends Model
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



    public function scopeToday($query)
    {
        // return $query->where(function ($query) {
        //                 $query->whereDate('start', '<=', date("Y-m-d"))
        //                     ->whereDate('end', '>=', date('Y-m-d'));
        //     });
        return $query->whereRaw('date(start) <= ? AND  date(end) >= ?', [date("Y-m-d"), date("Y-m-d")]);
    }
    public function scopeFuture($query)
    {
        $future = Settings::setting('future_day');

        return $query->whereDate('start', '>', date("Y-m-d"))
            ->whereDate('start', '<', date("Y-m-d", strtotime('+'. $future->value .' '. $future->unit)))
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
}
