<?php

namespace App\Console\Commands;

use App\Models\Cron;
use App\Models\TelegramSession;
use App\Services\EniscopeReadingService;
use Exception;
use Illuminate\Console\Command;
use danog\MadelineProto\API;
use Illuminate\Filesystem\Filesystem;

class SetUpTelegramCall extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:tg-call';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup telegram calling profile';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
     try{
         
         
         $this->warn("Please carefully read this information before proceeding!");
         $this->info("1. Your previous session settings will expire");
         $this->info("2. Enter your new session name, which will be used to call the users on alert.");
         $this->info("2. You can setup telegram session choosing manual option (a/m).");
         $this->info("3. System will configure new session.");
         $this->info("4. For making telegram call's we need to choose user from option. e.g. u/b, you should choose option `u`.");
         $this->info("5. Enter the contact number for session & follow the instructions accordingly");
         $this->info("6. If you get success message at the end means, you're done.");
         
             
         
         if ($this->confirm('Are You Sure To Setup New Telegram Session?', true)) {
             
             
            $this->info("Cleaning previous session..."); 
            $file = new Filesystem;
            sleep(1);
            $file->cleanDirectory(public_path('madeline/01'));
            $session=TelegramSession::first();
            if(!empty($session)){
                $session->delete();
            }
            $this->warn("Previous session has been destroyed.");  
            $session_name = $this->ask('Please enter telegram session name?');
            $session_name.='.madeline';//we will get abc.madeline
            $MadelineProto = new API(public_path('madeline/01/'.$session_name));
            $MadelineProto->start(); 
            
            $tg_session=TelegramSession::firstOrCreate(['name' => $session_name]);
            if($tg_session){
             $this->info("Session has been saved successfully!");   
            }
            sleep(5);
         
             $this->info("Session has been setup successfully, Congratulations!");
            
         }
         
     }   catch(Exception $exception){
         $this->error("there has been some error occured while setting up call, please see error.". $exception->getMessage());
     }
    }
}
