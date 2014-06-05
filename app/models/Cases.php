<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 5/21/14
 * Time: 11:51 AM
 */

use Illuminate\Database\Eloquent\Relations\BelongsTo,
    Illuminate\Database\Eloquent\Relations\BelongsToMany,
    Illuminate\Database\Eloquent\Relations\HasMany;

class Cases extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'case';


} 