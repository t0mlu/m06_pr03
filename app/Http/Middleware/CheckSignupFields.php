<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class CheckSignupFields
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validator = validator::make($request->all(), [
            'name' => ['required', 'string', 'regex:/^[A-Za-z\s]+$/'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:5'],
            'password_confirmation' =>  ['required', 'same:password']
        ]);

        return $validator->fails() ?
            response()->json(['errors' => $validator->errors()])
            : $next($request);
    }
}
