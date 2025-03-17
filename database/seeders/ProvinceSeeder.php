<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProvinceSeeder extends Seeder
{
    public function run()
    {
        // Path ke folder hasil ekstraksi
        $basePath = storage_path('app/private/master-location');

        // Fungsi untuk generate kode unik
        function generateCode() {
            return strtoupper(Str::random(8));
        }

        // Seeder untuk provinsi
        $provinsiData = json_decode(file_get_contents("$basePath/provinsi/provinsi.json"), true);
        foreach ($provinsiData as $id => $name) {
            DB::table('provinces')->insert([
                'id' => $id,
                'name' => $name,
                'code' => generateCode()
            ]);
        }

        // Seeder untuk kota/kabupaten
        foreach (glob("$basePath/kabupaten_kota/kab-*.json") as $file) {
            $provinceId = basename($file, ".json");
            $provinceId = str_replace('kab-', '', $provinceId);
            $citiesData = json_decode(file_get_contents($file), true);
            foreach ($citiesData as $id => $name) {
                DB::table('cities')->insert([
                    'id' => $provinceId . $id,
                    'name' => $name,
                    'province_id' => $provinceId,
                    'code' => generateCode()
                ]);
            }
        }

        // Seeder untuk kecamatan
        foreach (glob("$basePath/kecamatan/kec-*.json") as $file) {
            preg_match('/kec-(\d+)-(\d+)\.json/', basename($file), $matches);
            $provinceId = $matches[1];
            $cityId = $matches[2];
            $subdistrictsData = json_decode(file_get_contents($file), true);
            foreach ($subdistrictsData as $id => $name) {
                DB::table('subdistricts')->insert([
                    'id' => $provinceId . $cityId . $id,
                    'name' => $name,
                    'city_id' => $provinceId . $cityId,
                    'code' => generateCode()
                ]);
            }
        }

        // Seeder untuk kelurahan/desa
        foreach (glob("$basePath/kelurahan_desa/keldesa-*.json") as $file) {
            preg_match('/keldesa-(\d+)-(\d+)-(\d+)\.json/', basename($file), $matches);
            $provinceId = $matches[1];
            $cityId = $matches[2];
            $subdistrictId = $matches[3];
            $villagesData = json_decode(file_get_contents($file), true);
            foreach ($villagesData as $id => $name) {
                DB::table('villages')->insert([
                    'id' => $provinceId . $cityId . $subdistrictId . $id,
                    'name' => $name,
                    'subdistrict_id' => $provinceId . $cityId . $subdistrictId,
                    'code' => generateCode()
                ]);
            }
        }
    }
}