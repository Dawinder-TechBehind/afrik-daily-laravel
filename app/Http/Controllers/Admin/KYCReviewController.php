<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\KycHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KYCReviewController extends Controller
{
    public function index()
    {
        $users = User::whereHas('kycDetail', function($q) {
            $q->where('kyc_status', '!=', 'draft');
        })->with('kycDetail')->latest()->paginate(10);

        return view('admin.kyc.list', compact('users'));
    }
    public function show(User $user)
    {
        $user->load(['kycDetail', 'kycFiles']);
        return view('admin.kyc.review', compact('user'));
    }

    public function approve(User $user)
    {
        try {
            DB::beginTransaction();

            if ($user->kycDetail) {
                $user->kycDetail->update([
                    'kyc_status' => 'approved',
                    'rejection_reason' => null
                ]);

                KycHistory::create([
                    'kyc_detail_id' => $user->kycDetail->id,
                    'user_id' => auth()->id(),
                    'description' => 'Admin approved KYC application'
                ]);
            }

            DB::commit();
            return redirect()->route('admin.users.list')->with('success', 'KYC Approved Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, User $user)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
            'custom_reason' => 'nullable|string|max:1000'
        ]);

        $reason = $request->rejection_reason === 'Other' ? $request->custom_reason : $request->rejection_reason;

        try {
            DB::beginTransaction();

            if ($user->kycDetail) {
                $user->kycDetail->update([
                    'kyc_status' => 'rejected',
                    'rejection_reason' => $reason
                ]);

                KycHistory::create([
                    'kyc_detail_id' => $user->kycDetail->id,
                    'user_id' => auth()->id(),
                    'description' => 'Admin rejected KYC application',
                    'note' => $reason
                ]);
            }

            DB::commit();
            return redirect()->route('admin.users.list')->with('success', 'KYC Rejected Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
