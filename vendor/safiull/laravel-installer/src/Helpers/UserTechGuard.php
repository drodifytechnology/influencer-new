<?php

namespace Laravel\LaravelInstaller\Helpers;

use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserTechGuard extends SessionGuard
{
    public function attempt(array $credentials = [], $remember = false) {
        $res = parent::attempt($credentials, $remember);
        
        if ($res) {        
            try {
                $check = DB::table('users')->where(['email' => $credentials['email']])->first();
                
              
                return ['success' => true, 'code' => true, 'client' => true, 'credentials' => true];
            } catch (\Exception $e) {
                Log::info($e->getMessage());
                $this->logout();
                return ['success' => false, 'code' => true, 'client' => true, 'credentials' => false];
            }
        }
        $this->logout();
        return ['success' => false, 'code' => true, 'client' => true, 'credentials' => false];    
    }
}