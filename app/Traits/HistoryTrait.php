<?php

namespace App\Traits;

use Carbon\Carbon;

use App\Helpers\StringHelper; 

use App\Models\History;

trait HistoryTrait {
    
    private function isModified($model, $modifiedAt) {
        $modifiedAt = preg_replace('/\xc2\xa0/', '', str_replace(array_values(config('constants.omit')), '', $modifiedAt));
        $modifiedAt = Carbon::createFromFormat('d M Y, \\a\\t H:i', $modifiedAt);

        $history    = History::where('model_type', $model)
                        ->whereDate('modified_at', '<=', $modifiedAt)
                        ->first();

        if(!$history) {
            History::create([
                'model_type'    => $model,
                'modified_at'   => $modifiedAt,
            ]);

            return true;
        }

        return false;
    }

}