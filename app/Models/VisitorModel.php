<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorModel extends Model
{
    use HasFactory;
    protected $table = 'registration_data'; 

    public function country_1() {
        return $this->belongsTo(CountryModel::class,'country','id');
    }

    public function state_1() {
        return $this->belongsTo(StateModel::class,'state','id');
    }

    public function city_1() {
        return $this->belongsTo(CityModel::class,'city','id');
    }
}
