<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\BudgetReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KomunitasController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $komunitas = $user->komunitas;

        // Program aktif
        $activeCampaigns = Campaign::where('komunitas_id', $komunitas->id)
            ->where('status', 'active')
            ->get();

        // Total donasi diterima
        $totalDonations = Donation::whereHas('campaign', function ($query) use ($komunitas) {
                $query->where('komunitas_id', $komunitas->id);
            })
            ->sum('amount');

        return view('komunitas.dashboard', compact('activeCampaigns', 'totalDonations'));
    }

    public function createCampaign()
    {
        return view('komunitas.create-campaign');
    }

    public function storeCampaign(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'target_amount' => 'required|numeric|min:100000',
            'end_date' => 'required|date|after:today',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('campaign_images', 'public');

        Campaign::create([
            'title' => $request->title,
            'description' => $request->description,
            'target_amount' => $request->target_amount,
            'current_amount' => 0,
            'end_date' => $request->end_date,
            'komunitas_id' => Auth::user()->komunitas->id,
            'image_path' => $imagePath,
            'status' => 'pending'
        ]);

        return redirect()->route('komunitas.my-programs')->with('success', 'Kampanye berhasil diajukan!');
    }

    public function myPrograms()
    {
        $campaigns = Campaign::where('komunitas_id', Auth::user()->komunitas->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('komunitas.my-programs', compact('campaigns'));
    }

    public function budgetReport()
    {
        $reports = BudgetReport::where('komunitas_id', Auth::user()->komunitas->id)
            ->with('campaign')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('komunitas.budget-report', compact('reports'));
    }
}