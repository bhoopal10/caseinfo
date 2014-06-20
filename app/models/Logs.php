<?php
use Illuminate\Database\Eloquent\Relations\BelongsTo,
    Illuminate\Database\Eloquent\Relations\BelongsToMany,
    Illuminate\Database\Eloquent\Relations\HasMany;

class Logs extends Eloquent
{
	 /**
     * The database table used by the model.
     *
     * @var string
     */
     protected $table='logs';

     /**
     *Table with user relation
     *
     */
     public function user()
     {
     	return $this->belongsTo('User','id');
     }
}