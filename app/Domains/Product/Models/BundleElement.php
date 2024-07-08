<?php

namespace App\Domains\Product\Models;



use Illuminate\Database\Eloquent\Model;
use Termwind\Components\Element;

class BundleElement extends Model implements ElementInterface
{
    protected $fillable = ['name'];

    public function children()
    {
        return $this->belongsToMany(Element::class, 'element_element', 'parent_id', 'child_id')->withPivot('quantity');
    }

    public function getInventory(): int
    {
        return PHP_INT_MAX; // Bundle elements don't have a direct inventory count
    }

    public function calculateMaxBundles(): int
    {
        $maxBundles = PHP_INT_MAX;

        foreach ($this->children as $child) {
            $childElement = $child->type === 'part' ? Part::find($child->id) : BundleElement::find($child->id);
            $maxBundles = min($maxBundles, intdiv($childElement->calculateMaxBundles(), $child->pivot->quantity));
        }

        return $maxBundles;
    }
}
