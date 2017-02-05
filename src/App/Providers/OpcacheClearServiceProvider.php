<?php namespace CVEPDB\Opcache\Clear\App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class OpcacheClearServiceProvider
 * @package CVEPDB\Opcache\Clear\App\Providers
 */
class OpcacheClearServiceProvider extends ServiceProvider
{

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		include __DIR__ . '/../../routes.php';

		$this->app->make(
			\CVEPDB\Opcache\Clear\Http\Controllers\OpcacheClearController::class
		);

		$this->app->bind(
			'command.opcache:clear',
			\CVEPDB\Opcache\Clear\Console\Commands\OpcacheClearCommand::class
		);

		$this->commands([
			'command.opcache:clear',
		]);
	}
}
