<?php

namespace Config;

use App\Filters\AdminCek;
use App\Filters\AdminLogin;
use App\Filters\BengkelCek;
use App\Filters\BengkelLogin;
use App\Filters\ISLoggedIn;
use App\Filters\Logincuy;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     * @var array
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'Login'         => ISLoggedIn::class,
        'CekLogin'      => Logincuy::class,
        'CekAdmin'      => AdminCek::class,
        'LoginAdmin'    => AdminLogin::class,
        'CekBengkel'    => BengkelCek::class,
        'LoginBengkel'  => BengkelLogin::class,
        'logout' => \App\Filters\LogoutFilter::class

    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     * @var array
     */
    public array $globals = [
        'before' => [
            // 'honeypot',
            //'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [
        'logout' => [
            'before' => ['logout'],],
    ];
}
