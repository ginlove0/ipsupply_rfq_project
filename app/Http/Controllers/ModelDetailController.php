<?php

namespace App\Http\Controllers;

use App\ModelDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ModelDetailController extends Controller
{
    //
    public function addModelToDB($details, $group)
    {
        $modelDetails = json_decode($details);
        $groupDetails = json_decode($group);


        if($groupDetails === [])
        {
            $groupDetails = ["group-au", "group-us", "group-cn"];
        }

        foreach ($modelDetails as $detail)
        {
            ModelDetail::create([
                'name' => $detail->name,
                'condition' => $detail->condition,
                'qty' => $detail->qty,
                'serialRequired' => $detail->serialRequired,
                'note' => $detail->note,
                'meta' => $groupDetails
            ]);
        }
    }

    public function getModelDetail($userId)
    {
        $user = User::where('id', $userId)->first();
//        Log::info($user->meta['group']);

        $groups = $user->meta['group'];

        foreach ($groups as $group)
        {
            $models = ModelDetail::whereRaw('JSON_CONTAINS(meta, \'["' . $group . '"]\')')->get();

        }

        if($user->is_admin === 0)
        {
            return $models;

        }else{
            return ModelDetail::all();
        }

    }
}
