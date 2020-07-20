<?php

namespace App\Helpers\Classes;

use App\Models\Meta as MetaModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetaHelper
{
    public static function create(Request $request, Model $model, $parameters = null): MetaModel
    {
        $table = $model->getTable().'_id';
        $meta = new MetaModel();
        $meta->user_id = Auth::user();
        $meta->$table = $model->id;
        $meta->note = $request->note;
        $meta->link = $request->link;
        $meta->save();

        return $meta;
    }
}
