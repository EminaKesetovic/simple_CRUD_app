<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * Fillable columns in table clients
     * @var array
     */
    protected $fillable = [
                            'name',
                            'address',
                            'city_id',
                            'country_id',
                            'industry_type_id'
                          ];

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
     * Get the client's city.
     *
     * @return \App\Models\City
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the client's country.
     *
     * @return \App\Models\Country
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the client's industry type.
     *
     * @return \App\Models\IndustryType
     */
    public function industrytype()
    {
        return $this->belongsTo(IndustryType::class);
    }

    /**
     * The contact types that belong to the client.
     *
     * @return \App\Models\ContactType
     */
    public function contacttypes()
    {
        return $this->belongsToMany(ContactType::class, 'client_contacts', 'client_id', 'contact_type_id');
    }


}
