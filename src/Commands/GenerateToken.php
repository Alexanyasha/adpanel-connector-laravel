<?php

namespace DesignCoda\AdpanelConnector\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adpanel:generate_token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate auth token for Adpanel Connector';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $token = Str::random(50);

		try {
		
			// $this->call('env:set', [
			// 	'ADPANEL_CONNECTOR_TOKEN' => $token, 
			// ]);
			$this->info('New token ' . $token . ' was generated. Please set variable ADPANEL_CONNECTOR_TOKEN in .env file');
			$this->info('');
			$this->warn('ADPANEL_CONNECTOR_TOKEN=' . $token);
			$this->info('');
		
		} catch (\Exception $e) {
			$this->error('Generate token error');
			logger($e->getFile() . ' ' . $e->getLine() . ': ' . $e->getMessage());
		}
    }
}
