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
        $arrayObject = new \ArrayObject();
        $user = User::where('id', $userId)->first();

        $groups = $user->meta['group'];

        //foreach group belong to user
        foreach ($groups as $group)
        {
            //if model contain any group belong to user
            $models = ModelDetail::whereRaw('JSON_CONTAINS(meta, \'["' . $group . '"]\')')->get();
            foreach ($models as $model)
            {
                //push all model found to an object
                $arrayObject->append($model);

            }

        }

        //if user is not an admin, return object contain model can see
        //else return all because user is admin
        if($user->is_admin === 0)
        {
            return array_unique((array)$arrayObject);

        }else{
            return ModelDetail::all();
        }

    }

    public function deleteModel($modelId) {
        ModelDetail::where('id', $modelId)->delete();

        return view('home');
    }
}
