<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => function () use ($request) {
                return [
                    'user' => $request->user()
                        ? $request->user()->only('id', 'name', 'email', 'role')
                        : null,
                ];
            },
        ]);
    }

    public function handle(Request $request, \Closure $next)
    {

        if ($request->user() && $request->user()->status !== 'active') {

            if (auth()->check())
                auth('web')->logout();


            return Inertia::render('Auth/Login', [
                'errors' => ['inactive' => 'Your account is inactive. Please contact support for further assistance.'],
            ]);
        }

        return $next($request);
    }
}
