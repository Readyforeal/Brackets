<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Profile extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAge()
    {
        return Carbon::parse($this->attributes['dob'])->age;
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    public function profileImage()
    {
        $imagePath = ($this->profile_image) ? $this->profile_image : 'profile\default\brackets-default-profile-picture.png';
        return '/storage/' . $imagePath;
    }
}
