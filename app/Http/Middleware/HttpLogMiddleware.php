<?php

namespace App\Http\Middleware;

use App\Models\HttpLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HttpLogMiddleware
{
    /**
     * The HTTP log model instance.
     *
     * @var HttpLog|null
     */
    private static ?HttpLog $httpLog = null;

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure(Request): (Response)  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the application is running in the production environment
        if (app()->isProduction()) {
            // Resolve the right values from the request depending on the
            // HTTP method
            $attributes = $request->isMethod('GET')
                ? $request->query->all()
                : $request->request->all();

            if ([] === $attributes) {
                // In case there are no attributes, set it to NULL instead of
                // an empty array
                $attributes = null;
            }

            // Get all the headers from the request
            $headers = $request->headers->all();

            // Store the HTTP log model instance in a static property
            // to use it later when the response is sent
            self::$httpLog = new HttpLog([
                'user_id' => Auth::id(),
                'method' => $request->method(),
                'path' => $request->path(),
                'ip' => $request->ip(),
                'headers' => $headers,
                'attributes' => $attributes
            ]);
        }
        return $next($request);
    }

    /**
     * Handle an outgoing response.
     *
     * @param  Request  $request
     * @param  Response  $response
     * @noinspection PhpUnusedParameterInspection
     */
    public function terminate(Request $request, Response $response): void
    {
        if (null === static::$httpLog) {
            return;
        }

        // Set the status code of the response to the HTTP log model
        self::$httpLog->status_code = $response->getStatusCode();

        // Save the HTTP log model instance
        self::$httpLog->save();
    }
}
