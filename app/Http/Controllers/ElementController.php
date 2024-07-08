<?php

namespace App\Http\Controllers;

use App\Domains\Product\Models\Element;
use App\Http\Resources\ElementCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ElementController extends Controller
{
    public function index($id)
    {
       try {
       
        $element = Element::find($id);
        $maxBundles = $element->calculateMaxBundles();

        return response()->json([
            'element' => $element->name,
            'max_bundles' => $maxBundles,
            'status' => 'success'
        ]);
   
       } catch (\Throwable $th) {
        Log::warning('Failed to calculate product with error: '.$th->getMessage());
        return response()->json(['message' => 'Internal server error', 'status'=>'failure']);
       }
    }

    public function getBunldes(){
        try {
            $bundles = Element::whereNull('inventory')->get(); 
            return response()->json([
             "elements" => new ElementCollection($bundles),
                'status' => 'success'
            ]);
        } catch (\Throwable $th) {
            Log::warning('Failed to retrieve bundles with error: '.$th->getMessage());
            return response()->json(['message' => 'Internal server error', 'status'=>'failure']);
        }
    }

}