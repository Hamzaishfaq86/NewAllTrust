<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
        // Fetch the count of users assigned to specific roles.
        $adminCount = User::where('role', 'Admin')->count();
        $employeeCount = User::where('role', 'pre_approved_adviser_firm')->count();
        $advisorFirmAdminCount = User::where('role', 'advisor_firm')->count();
        $advisorCount = User::where('role', 'adviser')->count();
        $createOasisSippCount = User::where('role', 'oasis_sipp')->count();
        $createSippPropertyCount = User::where('role', 'sipp_property')->count();
        $createFullSippPropertyCount = User::where('role', 'full_sipp_property')->count();
        $createFptCount = User::where('role', 'fpt')->count();

        // Pass the data to the view
        return view('dashboard.report.index', compact(
            'adminCount',
            'employeeCount',
            'advisorFirmAdminCount',
            'advisorCount',
            'createOasisSippCount',
            'createSippPropertyCount',
            'createFullSippPropertyCount',
            'createFptCount'
        ));
    }
}
