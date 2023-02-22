<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ValidateApartmentFields
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validator = validator::make($request->all(), [
            'address' => ['string', 'max:100'],
            'city' => 'string',
            'postal_code' => ['string', 'size:5'],
            'rented_price' => ['numeric', 'min:0', 'regex:/^\d*(\.\d{1,2})?$/'],
            'rented' => 'boolean'
        ]);

        return $validator->fails() ?
            response()->json(['errors' => $validator->errors()], 422)
            : $next($request);
    }
}
