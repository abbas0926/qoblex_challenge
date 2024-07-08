<?php

namespace App\Domains\Product\Models;


use Illuminate\Database\Eloquent\Model;


class Part extends Model implements ElementInterface
{
    protected $fillable = ['name', 'inventory'];

    public function getInventory(): int
    {
        return $this->inventory;
    }

    public function calculateMaxBundles(): int
    {
        return $this->inventory?? 0;
    }
}
