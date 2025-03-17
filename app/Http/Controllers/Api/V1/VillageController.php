<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\ResponseCode;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VillageController extends Controller
{
    public function list(?string $subdistrictCode = null)
    {
        $subdisctrictId = $subdistrictCode
            ? DB::table('subdistricts')->where('code', $subdistrictCode)->value('id')
            : null;

        if ($subdistrictCode && is_null($subdisctrictId)) {
            return ResponseHelper::generate(ResponseCode::NotFound);
        }
        return ResponseHelper::generate(ResponseCode::Ok, [
            'items' => DB::table('villages')
                ->select(['code', 'name'])
                ->when($subdisctrictId, fn ($query) => $query->where('subdistrict_id', $subdisctrictId))
                ->orderBy('name')
                ->orderBy('id')
                ->get()
        ]);
    }
}
