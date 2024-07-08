<?php
namespace App\Domains\Product\Models;

interface ElementInterface
{
    public function getInventory(): int;
    public function calculateMaxBundles(): int;
}
