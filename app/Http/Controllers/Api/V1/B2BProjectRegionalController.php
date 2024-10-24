<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\B2BProject;
use Illuminate\Http\Request;

class B2BProjectRegionalController extends Controller
{
    public function fetchProvince(Request $request)
    {
        $provinces = B2BProject::select('province_code', 'province_name');

        if ($request->search) {
            $provinces = $provinces
                ->where('province_code', 'like', '%' . $request->search . '%')
                ->orWhere('province_name', 'like', '%' . $request->search . '%');
        }

        $provinces = $provinces->groupBy('province_code', 'province_name')->get();

        return response()->json([
            'status'    => 'ok',
            'message'   => 'B2B Project Regional for Provinces Fetched',
            'data'      => $provinces,
        ]);
    }

    public function fetchCity(Request $request)
    {
        $cities = B2BProject::select('city_code', 'city_name');

        if ($request->search) {
            $cities = $cities
                ->where('city_code', 'like', '%' . $request->search . '%')
                ->orWhere('city_name', 'like', '%' . $request->search . '%');
        }

        $cities = $cities->groupBy('city_code', 'city_name')->get();

        return response()->json([
            'status'    => 'ok',
            'message'   => 'B2B Project Regional for Cities Fetched',
            'data'      => $cities,
        ]);
    }

    public function fetchDistrict(Request $request)
    {
        $districts = B2BProject::select('district_code', 'district_name');

        if ($request->search) {
            $districts = $districts
                ->where('district_code', 'like', '%' . $request->search . '%')
                ->orWhere('district_name', 'like', '%' . $request->search . '%');
        }

        $districts = $districts->groupBy('district_code', 'district_name')->get();

        return response()->json([
            'status'    => 'ok',
            'message'   => 'B2B Project Regional for Districts Fetched',
            'data'      => $districts,
        ]);
    }

    public function fetchSubDistrict(Request $request)
    {
        $subDistricts = B2BProject::select('sub_district_code', 'sub_district_name');

        if ($request->search) {
            $subDistricts = $subDistricts
                ->where('sub_district_code', 'like', '%' . $request->search . '%')
                ->orWhere('sub_district_name', 'like', '%' . $request->search . '%');
        }

        $subDistricts = $subDistricts->groupBy('sub_district_code', 'sub_district_name')->get();

        return response()->json([
            'status'    => 'ok',
            'message'   => 'B2B Project Regional for Sub-Districts Fetched',
            'data'      => $subDistricts,
        ]);
    }
}
