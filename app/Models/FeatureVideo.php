<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureVideo extends Model
{
    use HasFactory;
    protected $fillable = [
        'feature_video_title',
        'feature_video_url',
        'feature_video',
    ];

}
