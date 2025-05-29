<?php declare(strict_types=1);

namespace KgBot\TikFinityWebhooks\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

class VerifyTikTokWebhookMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     *
     * @throws UnauthorizedException
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * Make sure the request is coming from secure TikFinity webhook
         *
         * All TikFinity webhook requests will have token as a query parameter
         */
        if (
            !app()->environment('local') &&
            $request->input('token') !== config('tikfinity-webhooks.token')
        ) {

            throw new UnauthorizedException;
        }


        return $next($request);
    }
}
