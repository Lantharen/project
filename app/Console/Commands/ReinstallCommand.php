<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ReinstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reinstall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reinstall the application using built-in commands.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        // Wipe database and run migrations
        $this->call('db:wipe');
        $this->call('migrate');

        // Clear all caches
        $this->call('cache:clear');
        $this->call('config:clear');
        $this->call('debugbar:clear');
        $this->call('event:clear');
        $this->call('optimize:clear');

        if ('sync' !== config('queue.default')) {
            $this->call('queue:clear');
        }

        $this->call('route:clear');
        $this->call('schedule:clear-cache');
        $this->call('view:clear');

        if (!app()->isProduction()) {
            // Create an admin user for development purposes
            $host = parse_url(config('app.url'), PHP_URL_HOST);

            $this->call('orchid:admin', [
                'name' => 'admin',
                'email' => 'admin@'.$host,
                'password' => 'admin',
            ]);
        } else {
            // Optimize and cache everything
            $this->call('optimize');
            $this->call('config:cache');
            $this->call('event:cache');
            $this->call('route:cache');
            $this->call('view:cache');
        }

        $this->call('db:seed');
    }
}
