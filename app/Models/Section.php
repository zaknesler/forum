<?php

namespace App\Models;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * A section has many topics.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
