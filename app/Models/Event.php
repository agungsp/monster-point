<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'Events';
    protected $primaryKey = 'Id';

    const CREATED_AT = 'CreateDate';
    const UPDATED_AT = 'LastUpdate';

    protected $guarded = ['Id', 'Guid', 'CreateDate', 'LastUpdate'];
    protected $hidden = ['Times'];

    /**
     * Get the merchant that owns the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'IdMerchant', 'Id');
    }

}
