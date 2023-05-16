<?php

namespace App\Http\Controllers;

use App\Models\DetailOperation;
use App\Models\OperationDon;
use App\Models\Tiers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $total_donors = Tiers::where('key_tiers_type', 2)->count();
        $total_donations = DetailOperation::count();

        $blood_stats = DB::select('SELECT tiers.groupage, COUNT(*) as count, COUNT(*) * 100 /(' . $total_donors . ') as percentage FROM tiers 
        INNER JOIN detail_operation ON detail_operation.key_tiers = tiers.key_tiers
        WHERE tiers.key_tiers_type = 2
        GROUP BY tiers.groupage ORDER BY tiers.groupage asc');

        $age_stats = DB::select('SELECT 
        CASE 
            WHEN age >= 18 AND age <= 30 THEN "18-30"
            WHEN age > 30 AND age <= 40 THEN "30-40"
            WHEN age > 40 AND age <= 50 THEN "40-50"
            WHEN age > 50 AND age <= 60 THEN "50-60"
            ELSE "60+"
        END AS age_range, 
        COUNT(*) as count,
        COUNT(*) * 100 /(' . $total_donors . ') as percentage
        FROM (
            SELECT TIMESTAMPDIFF(YEAR, tiers.date_naissance, CURDATE()) AS age 
            FROM tiers
            where tiers.key_tiers_type = 2
        ) AS age_grouped
        GROUP BY age_range 
        ORDER BY age_range DESC');

        return view('pages.dashboard.dashboard', [
            'blood_stats' => $blood_stats,
            'age_stats' => $age_stats,
            'total' => $total_donors,
            'total_donations'=>$total_donations
        ]);
    }

    public function campaignStatsJson()
    {
        $campaigns_per_year = DB::select(
            'SELECT  year(operation_don.date_operation) AS year, 
        COUNT(*) AS count FROM operation_don
        GROUP BY 1'
        );
        $donors_per_aghermes = DB::select(
            'SELECT  agherme.agherme, 
            COUNT(*) AS count FROM detail_operation
            inner join tiers on tiers.key_tiers = detail_operation.key_tiers 
            inner join agherme on agherme.key_agherme = tiers.key_agherme
            GROUP BY 1 ORDER BY 2 DESC'
        );
        $donations_per_year = DB::select(
            'SELECT  year(operation_don.date_operation) AS year, 
            COUNT(*) AS count FROM operation_don INNER JOIN detail_operation ON detail_operation.key_operation = operation_don.key_operation
            GROUP BY 1'
        );

        $total_compaigns = OperationDon::All()->count();
        return response()->json([
            'campaigns_per_year' => $campaigns_per_year,
            'total_compaigns' => $total_compaigns,
            'donors_per_aghermes' => $donors_per_aghermes,
            'donations_per_year'=>$donations_per_year
        ]);
    }
}