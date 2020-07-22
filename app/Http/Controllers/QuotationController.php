<?php

namespace App\Http\Controllers;

use App\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuotationController extends Controller
{
    //
    public function addQuotationToDb($quotationList, $userId, $freeShipping)
    {
        $objQuotation = json_decode($quotationList);
        $objUser = json_decode($userId);

        Log::info($quotationList);

        foreach ($objQuotation as $details){
            foreach ($details as $detail){
                Quotation::create([
                    'modelId' => $detail->modelId,
                    'userId' => $objUser->id,
                    'qty' => $detail->qty,
                    'condition' => $detail->condition,
                    'note' => $detail->note,
                    'price' => $detail->unitPrice,
                    'free_shipping' => $freeShipping,
                    'serialNumber' => $detail->serialNumber
                ]);
            }
        }

    }
}
