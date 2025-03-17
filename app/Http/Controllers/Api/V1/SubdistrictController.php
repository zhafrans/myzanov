<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\ResponseCode;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubdistrictController extends Controller
{
    public function list(?string $cityCode = null)
    {
        $cityId = $cityCode
            ? DB::table('cities')->where('code', $cityCode)->value('id')
            : null;

        if ($cityCode && is_null($cityId)) {
            return ResponseHelper::generate(ResponseCode::InvalidCity);
        }

        return ResponseHelper::generate(ResponseCode::Ok, [
            'items' => DB::table('subdistricts')
                ->select(['code', 'name'])
                ->when($cityId, fn ($query) => $query->where('city_id', $cityId))
                ->orderBy('name')
                ->orderBy('id')
                ->get()
        ]);
    }
}
