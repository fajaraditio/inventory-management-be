<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ProjectReport;
use Illuminate\Http\Request;

class ProjectReportController extends Controller
{
    public function fetch(Request $request)
    {
        $projectReports = new ProjectReport();

        if ($request->search) {
            $projectReports = $projectReports
                ->where('salesman_name', 'like', '%' . $request->search . '%')
                ->orWhere('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        $projectReports = $projectReports->paginate();

        return response()->json(
            array_merge(
                [
                    'status'    => 'ok',
                    'message'   => 'Project reports table fetched',
                ],
                $projectReports->toArray()
            )
        );
    }

    public function fetchId($id)
    {
        $projectReport = ProjectReport::find($id);

        return response()->json(
            [
                'status'    => 'ok',
                'message'   => 'Project reports table fetched',
                'data' => $projectReport->toArray(),
            ]
        );
    }
}
