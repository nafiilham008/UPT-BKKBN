<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Post;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $post = Post::all();

        $user = User::all();

        $maintenanceStatus = Maintenance::select('is_maintenance')->first();

        return view('dashboard', compact('post', 'user', 'maintenanceStatus'));
    }

    public function updateMaintenance(Request $request)
    {
        $maintenanceStatus = $request->input('maintenance', 0);
        // dd($maintenanceStatus);

        Maintenance::updateOrCreate(
            ['id' => 1],
            ['is_maintenance' => $maintenanceStatus]
        );

        return redirect()->route('dashboard')->with('success', 'Maintenance mode is Active');
    }
}
