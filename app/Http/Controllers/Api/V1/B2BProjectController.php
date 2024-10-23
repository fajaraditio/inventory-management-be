<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\CosineSimilarity;
use App\Helpers\HaversineFormula;
use App\Http\Controllers\Controller;
use App\Models\B2BProject;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;

class B2BProjectController extends Controller
{
    public function checkSimilarityAll(Request $request)
    {
        $validated = $request->validate([
            'project_name'      => 'required|string',
            'address'           => 'nullable|string',
            'province_name'     => 'nullable|string',
            'city_name'         => 'nullable|string',
            'district_name'     => 'nullable|string',
            'sub_district_name' => 'nullable|string',
            'latitude'          => 'nullable|string',
            'longitude'         => 'nullable|string',
            'detail_address'    => 'nullable|string',
            'total_amount'      => 'nullable|numeric',
        ]);

        $projects = B2BProject::all();

        $totalVariables = 8;
        $similarities = [];

        foreach ($projects as $project) {
            $projectNameSimilarity      = CosineSimilarity::checkPercentage($project->project_name, $request->project_name);
            $detailAddressSimilarity    = CosineSimilarity::checkPercentage($project->detail_address, $request->detail_address);
            $provinceNameSimilarity     = CosineSimilarity::checkPercentage($project->province_name, $request->province_name);
            $cityNameSimilarity         = CosineSimilarity::checkPercentage($project->city_name, $request->city_name);
            $districtSimilarity         = CosineSimilarity::checkPercentage($project->district_name, $request->district_name);
            $subDistrictSimilarity      = CosineSimilarity::checkPercentage($project->sub_district_name, $request->sub_district_name);
            $totalAmountSimilarity      = CosineSimilarity::checkPercentage($project->total_amount, $request->total_amount);
            $geoSimilarity              = HaversineFormula::checkGeoSimilarity($project->latitude, $project->longitude, $request->latitude, $request->longitude);

            $mergeSimilarity = ($projectNameSimilarity + $detailAddressSimilarity + $provinceNameSimilarity + $cityNameSimilarity + $districtSimilarity + $subDistrictSimilarity + $totalAmountSimilarity + $geoSimilarity) / $totalVariables;

            $similarities[] = array_merge($project->toArray(), ['cosine_similarities' => [
                'total_score'               => $mergeSimilarity,
                'project_name_similarity'   => $projectNameSimilarity,
                'detail_address_similarity' => $detailAddressSimilarity,
                'province_name_similarity'  => $provinceNameSimilarity,
                'city_name_similarity'      => $cityNameSimilarity,
                'district_similarity'       => $districtSimilarity,
                'sub_district_similarity'   => $subDistrictSimilarity,
                'geo_similarity'            => $geoSimilarity,
                'total_amount_similarity'   => $totalAmountSimilarity,
            ]]);
        }

        return response()->json([
            'status' => 'ok',
            'message' => 'Similarities of B2B Project Fetched',
            'data' => $similarities,
        ]);
    }
}