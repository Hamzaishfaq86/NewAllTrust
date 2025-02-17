<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MarketManagementController extends Controller
{
    /**
     * Show the form for sending emails.
     */
    public function mailIndex()
    {
        // Fetch users based on their roles from the migration definition
        $roles = [
            'advisor',
            'oasis_sipp',
            'sipp_property',
            'full_sipp_property',
            'fpt'
        ];

        // Fetch users with any of the roles above
        $users = User::whereIn('role', $roles)->get();

        // Return view with the users
        return view('dashboard.mail.index', compact('users'));
    }
}
