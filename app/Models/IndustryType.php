<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryType extends Model
{
    use HasFactory;

    /**
     * Fillable columns in table industry_types
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Hide these columns in JSON response. These columns will not be shown in get requests (selects from database)
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    /**
     * Make attributes available in the json response
     *
     * @var array
     */
    protected $appends = [
        'clients_number'
    ];

    /**
     * Get the clients for the industry type
     *
     * @return \App\Models\Client
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    /**
     * Custom clients_number attribute for industry type model
     *
     * @return int
     */
    public function getClientsNumberAttribute()
    {
        return $this->clients()->count();
    }
}
