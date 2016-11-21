<?php namespace CVEPDB\Opcache\Clear\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Encryption\DecryptException;

/**
 * Class OpcacheClearController
 * @package CVEPDB\Opcache\Clear\Http\Controllers
 */
class OpcacheClearController extends Controller
{

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function opcacheClear(Request $request)
	{
		$result = false;
		$decrypted = null;
		$original = config('app.key');

		try
		{
			$decrypted = \Crypt::decrypt($request->get('token'));

			if (($decrypted === $original) && \opcache_reset())
			{
				$result = true;
			}
		}
		catch (DecryptException $e)
		{
			$result = false;

			\Log::error($e->getMessage());
		}
		catch (\Exception $e)
		{
			$result = false;

			\Log::error($e->getMessage());
		}

		return response()->json(['result' => $result]);
	}
}
