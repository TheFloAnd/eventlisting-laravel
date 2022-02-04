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
        //                 $query->whereDate('start', '<=', strftime('%Y-%m-%d'))
        //                     ->whereDate('end', '>=', date('Y-m-d'));
        //     });
        return $query->whereRaw('date(start) <= ? AND  date(end) >= ?', [strftime('%Y-%m-%d'), strftime('%Y-%m-%d')]);
    }
    public function scopeFuture($query)
    {
        return $query->whereDate('start', '>', strftime('%Y-%m-%d'))
            ->whereNull('deleted_at')
            ->orderBy('start');
    }

    // public function scopeFormat($query)
    // {
    //     return $query->select('*', DB::raw('
    //                                 DATE_FORMAT(created_at,"%d.%m.%Y") as date,
    //                                 DATE_FORMAT(created_at,"%H:%i:%s") as time_created,
    //                                 DATE_FORMAT(created_at,"%d.%m.%Y %H:%i:%s") as created
    //                             '));
    // }


    // public function scopeProposals($query)
    // {
    //     return $query->select('eaten', DB::raw('COUNT(`eaten`) as count'))
    //         ->whereNull('deleted_at')
    //         ->groupBy('eaten')
    //         ->orderBy('count', 'DESC')
    //         ->inRandomOrder();
    // }
}
