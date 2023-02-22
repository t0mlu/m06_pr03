<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class CheckRequiredApartmentId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validator = validator::make($request->all(), [
            'id' => ['required', 'integer', 'min:0']
        ]);

        return $validator->fails() ?
            response()->json(['errors' => $validator->errors()], 422)
            : $next($request);
    }
}
