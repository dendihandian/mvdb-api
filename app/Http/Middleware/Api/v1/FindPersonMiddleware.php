<?php

namespace App\Http\Middleware\Api\v1;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Person;
use Closure;
use Illuminate\Http\Request;

class FindPersonMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $personId = $request->personId ?? null;

        if (!$person = Person::where(['id' => $personId])->first()) {
            throw new ResourceNotFoundException();
        }

        $request->merge([
            'person' => $person,
        ]);

        return $next($request);
    }
}
