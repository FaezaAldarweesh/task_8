<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\User;
use App\Jobs\MailSend;
use App\Mail\SendMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DailyMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
    $TaskPending = Task::select('title')->where('status', '=', 'Pending')->get();

    Log::info('Pending tasks:', ['tasks' => $TaskPending]);

    MailSend::dispatch($TaskPending);
}

}
