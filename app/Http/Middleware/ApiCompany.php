<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\Users;

class ApiCompany
{
    use Users;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $company_id = $request->get('company_id');

        if (empty($company_id)) {
            return $next($request);
        }

        // Check if user can access company
        if (!$this->isUserCompany($company_id)) {
            return $next($request);
        }

        // Set company id
        session(['company_id' => $company_id]);

        // Set the company settings
        setting()->setExtraColumns(['company_id' => $company_id]);
        setting()->load(true);

        return $next($request);
    }
}
