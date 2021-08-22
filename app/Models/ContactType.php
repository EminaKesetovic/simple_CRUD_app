<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactType extends Model
{
    use HasFactory;

    /**
     * Fillable columns in table contact_types
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
     * The clients that belong to the contact type
     *
     * @return \App\Models\ContactType
     */
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_contacts', 'contact_type_id', 'client_id');
    }

    /**
     * Custom clients_number attribute for contact type model
     *
     * @return int
     */
    public function getClientsNumberAttribute()
    {
        return $this->clients()->count();
    }
}
