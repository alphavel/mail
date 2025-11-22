<?php

declare(strict_types=1);

namespace Alphavel\Mail;

use Alphavel\ServiceProvider;

/**
 * Mail Service Provider
 * 
 * Auto-discovery: No configuration required
 * Performance: Singleton with lazy connection
 */
class MailServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register mail manager as singleton
        $this->app->singleton('mail', function ($app) {
            $config = $app->make('config')->get('mail', []);
            return new MailManager($config);
        });
    }
    
    public function boot(): void
    {
        // Publish config if needed
        $this->publishes([
            __DIR__ . '/../config/mail.php' => $this->app->basePath('config/mail.php'),
        ], 'config');
    }
}
