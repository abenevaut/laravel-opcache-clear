<?php

namespace MicheleCurletta\LaravelOpcacheClear;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
 
class OpcacheClearController extends Controller
{
 
    protected function opcacheClear(Request $request)
    {   
        $original = config('app.key').config('app.url');

        $result = false;

        $decrypted = null;

        try {

            $decrypted = Crypt::decrypt($request->get('token'));

        } catch (DecryptException $e) {
            

        }

        if(($decrypted == $original) && opcache_reset())
                $result = true;
        
        return response()->json(["result"=>$result]);
    }
 
}