<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Groups extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'groups';

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
        'alias',
        'name',
        'color',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function scopeUsed($query)
    {
        return $query->whereNull('deleted_at')->orderBy('id');
    }

    public function scopeUnused($query)
    {
        return $query->whereNotNull('deleted_at')->orderBy('id');
    }

    public function scopeAlias($query, $alias)
    {
        return $query->where('alias', $alias)->withTrashed();
    }

}
