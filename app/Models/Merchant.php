<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;
    protected $hidden = ['Times'];
    protected $table = 'dbo.Merchant';
    protected $primaryKey = 'Id';
    protected $fillable = ['CreateDate', 'Token', 'Nama', 'Alamat', 'Pic', 'PicTelp', 'Email', 'Pass', 'Kebutuhan', 'LastUpdate', 'Akif', 'Validasi'];
    const CREATED_AT = 'CreateDate';
    const UPDATED_AT = 'LastUpdate';

    /**
     * Get all of the events for the Merchant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany(Event::class, 'IdMerchant', 'Id');
    }
}
