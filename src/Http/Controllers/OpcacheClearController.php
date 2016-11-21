<?php namespace CVEPDB\Opcache\Clear\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use CVEPDB\Opcache\Clear\Http\Request\OpcacheClearFormRequest;

/**
 * Class OpcacheClearController
 * @package CVEPDB\Opcache\Clear\Http\Controllers
 */
class OpcacheClearController extends Controller
{

	/**
	 * @param OpcacheClearFormRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function opcacheClear(OpcacheClearFormRequest $request)
	{
		$result = false;
		$decrypted = null;
		$original = config('app.key');

		try
		{
			$decrypted = \Crypt::decrypt($request->get('token'));
		}
		catch (DecryptException $e)
		{
			\Log::error($e->getMessage());
		}

		if (($decrypted == $original) && opcache_reset())
		{
			$result = true;
		}

		return response()->json(["result" => $result]);
	}
}