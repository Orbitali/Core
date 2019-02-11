<?php

namespace Orbitali\Http\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteLanguage extends Model
{
    protected $guarded = [];
    protected $table = 'website_languages';

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

}
