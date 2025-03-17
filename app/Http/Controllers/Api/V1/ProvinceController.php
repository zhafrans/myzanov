<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\ResponseCode;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinceController extends Controller
{
    public function list()
    {
        return ResponseHelper::generate(ResponseCode::Ok, [
            'items' => DB::table('provinces')
                ->select(['code', 'name'])
                ->orderBy('name')
                ->orderBy('id')
                ->get()
        ]);
    }
}
