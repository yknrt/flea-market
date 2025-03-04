<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use App\Http\Requests\LoginRequest;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;
use App\Actions\Fortify\CustomLoginAction;
use App\Models\User;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/');
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        Fortify::registerView(function () {
            return view('auth.register');
        });

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(10)->by($email . $request->ip());
        });

        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });

        // ユーザー登録後のリダイレクト先
        $this->app->singleton(RegisterResponse::class, function () {
            return new class implements RegisterResponse {
                public function toResponse($request)
                {
                    return redirect()->route('profile'); // 遷移先のルート名を指定
                }
            };
        });

        // $this->app->bind(FortifyLoginRequest::class, LoginRequest::class);

        Fortify::loginView(function () {
            return view('auth.login');
        });

        // Fortifyのログイン処理を独自のLoginRequestで設定
        // Fortify::authenticateUsing(function (LoginRequest $request) {
        //     $user = User::where('email', $request->email)->first();
        //     if ($user && Hash::check($request->password, $user->password)) {
        //         return $user;
        //     }

        //     return null;
        // });

        // ログイン後のリダイレクト先
        Fortify::redirects('login', '/?page=mylist');

    }
}
