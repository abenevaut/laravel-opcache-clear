<?php namespace ABENEVAUT\Opcache\Clear\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

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
		$debug = false;

		try
		{
			$encryptedToken = Crypt::encrypt(config('app.key'));

			$client = new Client(['debug' => $debug, 'timeout' => 60]);

			$response = $client->get(
				rtrim(config('app.url', 'http://localhost/'), '/') . '/opcache-clear',
				[
					'debug' => $debug,
					'query' => [
						'token' => $encryptedToken
					]
				]
			);

			$json = \GuzzleHttp\json_decode($response->getBody()->getContents());

			if ($json->result)
			{
				$this->line('OpCache cleared');

				return 0;
			}
		}
		catch (DecryptException $e)
		{
			Log::error($e->getMessage());
		}
		catch (\Exception $e)
		{
			Log::error($e->getMessage());
		}

		$this->error('Something went wrong!');

		return 1;
	}
}
