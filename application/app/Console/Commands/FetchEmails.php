<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FetchEmails extends Command
{
     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch emails from the IMAP server';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $emailController = new Emails();
            $emailController->fetchEmails();
            $this->info('Emails fetched successfully.');
        } catch (\Exception $e) {
            $this->error('Error fetching emails: ' . $e->getMessage());
        }

        return 0;
    }
}
