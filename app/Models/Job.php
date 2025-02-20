<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
      protected $table = 'job_posts'; 
     protected $fillable = [
        'title', 'description', 'experience', 'salary',
        'location', 'extra_info', 'company_name', 'logo'
    ];
    
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}