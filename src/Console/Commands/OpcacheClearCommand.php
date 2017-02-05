<?php namespace ABENEVAUT\Opcache\Clear\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Contracts\Encryption\DecryptException;

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
			$encryptedToken = \Crypt::encrypt(config('app.key'));

			$client = new Client(['debug' => $debug, 'timeout' => 60]);

			$response = $client->get(
				config('app.url', 'http://localhost/') . 'opcache-clear',
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
				$this->line('So far, so good.');

				return 1;
			}
		}
		catch (DecryptException $e)
		{
			\Log::error($e->getMessage());
		}
		catch (\Exception $e)
		{
			\Log::error($e->getMessage());
		}

		$this->error('Ooops!');

		return 0;
	}
}
