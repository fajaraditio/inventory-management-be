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
    public function fetchAll(Request $request)
    {
        $projects = B2BProject::paginate();

        return response()->json(
            array_merge(
                [
                    'status'    => 'ok',
                    'message'   => 'B2B Projects Fetched',
                ],
                $projects->toArray(),
            )
        );
    }

    public function fetchId($id)
    {
        $projects = B2BProject::find($id);

        return response()->json(
            [
                'status'    => 'ok',
                'message'   => 'B2B Projects Fetched',
                'data'      => $projects,
            ],
        );
    }

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

        $totalVariables = (!empty($request->latitude) || !empty($request->longitude)) ? count($validated) - 1 : count($validated); // subtract with 1 if lat / long is filled, because it will return only geo similarities variables
        $similarities = [];

        foreach ($projects as $project) {
            $projectNameSimilarity      = CosineSimilarity::checkPercentage($project->project_name, $request->project_name);
            $detailAddressSimilarity    = CosineSimilarity::checkPercentage($project->detail_address, $request->detail_address);
            $provinceNameSimilarity     = CosineSimilarity::checkPercentage($project->province_name, $request->province_name);
            $cityNameSimilarity         = CosineSimilarity::checkPercentage($project->city_name, $request->city_name);
            $districtSimilarity         = CosineSimilarity::checkPercentage($project->district_name, $request->district_name);
            $subDistrictSimilarity      = CosineSimilarity::checkPercentage($project->sub_district_name, $request->sub_district_name);
            $geoSimilarity              = HaversineFormula::checkGeoSimilarity($project->latitude, $project->longitude, $request->latitude, $request->longitude);

            $totalAmountSimilarity      = (min($project->total_amount, $request->total_amount) / max($project->total_amount, $request->total_amount)) * 100; // smaller value formula
            $mergeSimilarity            = ($projectNameSimilarity + $detailAddressSimilarity + $provinceNameSimilarity + $cityNameSimilarity + $districtSimilarity + $subDistrictSimilarity + $totalAmountSimilarity + $geoSimilarity) / $totalVariables; // haversine formula

            $similarities[] = array_merge($project->toArray(), [
                'total_similarity' => $mergeSimilarity,
                'project_status' => $mergeSimilarity > 70 ? 'Existing Project' : 'New Project',
                'similarities' => [
                    'project_name_similarity'   => $projectNameSimilarity,
                    'detail_address_similarity' => $detailAddressSimilarity,
                    'province_name_similarity'  => $provinceNameSimilarity,
                    'city_name_similarity'      => $cityNameSimilarity,
                    'district_similarity'       => $districtSimilarity,
                    'sub_district_similarity'   => $subDistrictSimilarity,
                    'geo_similarity'            => $geoSimilarity,
                    'total_amount_similarity'   => $totalAmountSimilarity,
                ]
            ]);
        }

        $projects = collect($similarities);

        $projects = $projects->sortByDesc('total_similarity');

        return response()->json([
            'status' => 'ok',
            'message' => 'Similarities of B2B Project Fetched',
            'data' => $projects->values()->all(),
        ]);
    }
}
