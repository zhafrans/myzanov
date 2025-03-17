<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\ResponseCode;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function list(?string $provinceCode = null)
    {
        $provinceId = $provinceCode
        ? DB::table('provinces')->where('code', $provinceCode)->value('id')
        : null;

        if ($provinceCode && is_null($provinceId)) {
            return ResponseHelper::generate(ResponseCode::InvalidProvince);
        }

        return ResponseHelper::generate(ResponseCode::Ok, [
            'items' => DB::table('cities')
                ->select(['code', 'name'])
                ->when($provinceId, fn ($query) => $query->where('province_id', $provinceId))
                ->orderBy('name')
                ->orderBy('id')
                ->get()
        ]);
    }
}
