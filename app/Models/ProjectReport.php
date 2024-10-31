<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectReport extends Model
{
    public function project_report_images()
    {
        return $this->hasMany(ProjectReportImages::class);
    }
}
