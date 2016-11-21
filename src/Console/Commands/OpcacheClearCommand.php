<?php namespace CVEPDB\Opcache\Clear\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;

/**
 * Class OpcacheClearCommand
 * @package CVEPDB\Opcache\Clear\Console\Commands
 */
class OpcacheClearCommand extends Command
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
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$client = new Client;
		$originalToken = config('app.key');
		$encryptedToken = \Crypt::encrypt($originalToken);

		$request = $client->createRequest('DELETE', config('app.url', 'http://localhost'));
		$request->setPath('/opcache-clear');
		$request->getQuery()->set('token', $encryptedToken);
		$response = $client->send($request);

		if (($response->json()['result']))
		{
			$this->line('So far, so good.');
		}
		else
		{
			$this->line('Ooops!');
		}
	}
}
