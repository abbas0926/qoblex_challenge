<?php

namespace App\Domains\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Element extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'inventory', 'type'];

    public function children()
    {
        return $this->belongsToMany(Element::class, 'element_element', 'parent_id', 'child_id')->withPivot('quantity');
    }

    public function parents()
    {
        return $this->belongsToMany(Element::class, 'element_element', 'child_id', 'parent_id')->withPivot('quantity');
    }

    public function calculateMaxBundles(): int
    {
        if ($this->type === 'part') {
            return $this->inventory;
        }

        $maxBundles = PHP_INT_MAX;

        foreach ($this->children as $child) {
            $childMaxBundles = $child->calculateMaxBundles();
            $maxBundles = min($maxBundles, intdiv($childMaxBundles, $child->pivot->quantity));
        }

        return $maxBundles;
    }
}
