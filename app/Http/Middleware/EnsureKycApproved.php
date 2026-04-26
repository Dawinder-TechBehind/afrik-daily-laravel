<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureKycApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $kycStatus = auth()->user()->kycDetail->kyc_status ?? 'draft';

        if ($kycStatus !== 'approved') {
            return redirect()->route('investor.index')
                ->with('error', 'You must complete and have your KYC approved before you can make an investment.');
        }

        return $next($request);
    }
}
