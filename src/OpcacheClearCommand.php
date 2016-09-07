<?php

namespace MicheleCurletta\LaravelOPCacheClear;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Crypt;

class OPCacheClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'opcache:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear OpCache';

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
        $client = new Client;
        $request = $client->createRequest('GET', 'http://localhost/opcache-clear');

        $originalToken = config('app.key').config('app.url');

        $encryptedToken = Crypt::encrypt($originalToken);

        $request->getQuery()->set('token', $encryptedToken);

        $response = $client->send($request);

        if(($response->json()['result']))
            $this->line('So far, so good.');
        else
            $this->line('Ooops!');

    }
}
