<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Search extends Model implements \Stringable
{
    use Cacheable;

    public $timestamps = false;
    protected $table = "search_view";
    protected $casts = [
        "name" => "string",
        "value" => "json",
        "detail_value" => "json",
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function __toString()
    {
        return $this->url;
    }

    public static function search($content)
    {
        $orb = orbitali();
        $content = "%" . $content . "%";
        return self::query()
            ->where("website_id", $orb->website->id)
            ->where("language", $orb->language)
            ->where(function ($q) use ($content) {
                $q->WhereRaw("lower(`name`) like ?", [$content])
                    ->orWhereRaw(
                        "JSON_VALID(JSON_SEARCH(lower(`value`), 'all', lower(?))) = 1",
                        [$content]
                    )
                    ->orWhereRaw(
                        "JSON_VALID(JSON_SEARCH(lower(`detail_value`), 'all', lower(?))) = 1",
                        [$content]
                    );
            });
    }
}
