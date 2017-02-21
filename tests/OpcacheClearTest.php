<?php

use Illuminate\Foundation\Testing\TestCase;

class OpcacheClearTest extends TestCase
{

	public function setUp()
	{
		if (!$this->app)
		{
			$this->refreshApplication();
		}

		$this
			->app['config']
			->set(
				[
					'app' => [
						'key'       => 'base64:4ilJcXYfkvylbs5Q1fFiTKTvl+Dpkf4kH8TwSJfKdEI=',
						'cipher'    => 'AES-256-CBC',
						'log'       => 'single',
						'log_level' => 'debug',
					]
				]
			);
	}

	public function test_clear_cache()
	{
		$response = $this->call(
			'GET',
			'opcache-clear',
			[
				'token' => $this
					->app['encrypter']
					->encrypt('base64:4ilJcXYfkvylbs5Q1fFiTKTvl+Dpkf4kH8TwSJfKdEI=')
			]
		);

		$this->assertEquals(true, $response->original['result']);
	}

	public function createApplication()
	{
		$app = require __DIR__ . '/bootstrap/app.php';
		$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

		return $app;
	}
}