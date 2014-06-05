<?php
/**
 * Created by PhpStorm.
 * User: bhoo
 * Date: 5/22/14
 * Time: 12:25 PM
 */

namespace libraries;


use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Database\Eloquent\Relations\BelongsTo,
    Illuminate\Database\Eloquent\Relations\BelongsToMany,
    Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class libCase extends EloquentUserProvider
{
    public $table='case';
    public static function seach()
    {
        $year=DB::table('case')->get();
        return $year;
    }
    public static function year()
    {
        $year=DB::select('select date_format(jdate,?) as jdate from `case` group by date_format(jdate,?)',array('%Y','%Y')) ;
        return $year;
    }
    public static function groupAttribute($attr)
    {
        $res=DB::select("select distinct $attr as val from `case` where $attr is not null group by trim($attr)");
        return $res;
    }


} 