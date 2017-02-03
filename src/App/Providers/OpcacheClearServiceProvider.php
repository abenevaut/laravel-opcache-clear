<?php namespace ABENEVAUT\Opcache\Clear\App\Providers;

use Illuminate\Support\ServiceProvider;

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
			\ABENEVAUT\Opcache\Clear\Http\Controllers\OpcacheClearController::class
		);

		$this->app->bind(
			'command.opcache:clear',
			\ABENEVAUT\Opcache\Clear\Console\Commands\OpcacheClearCommand::class
		);

		$this->commands([
			'command.opcache:clear',
		]);
	}
}
