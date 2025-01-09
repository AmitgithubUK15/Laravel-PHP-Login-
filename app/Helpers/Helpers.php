<?php

namespace App\Helpers;

use App\Models\Cookiemaping;
use Exception;
use Illuminate\Support\Facades\DB;

use function Pest\Laravel\json;

class Helpers
{
  // Set cookie in DB in [cookiemapings] table
  public function  SetCookieinMap($userid, $encryptkey)
  {
    try{
    $finduser = DB::table('cookiemapings')->where('userid', $userid)->first();
    $maping = null;
  
    if ($finduser) {
      DB::table('cookiemapings')
        ->where('userid', $userid)
        ->update(['cookie' => $encryptkey]);
        
        return [
          'success'=>true,
          'message'=>'Successfully updated'
        ];
    } else {
      $maping = new Cookiemaping();
      $maping->userid = $userid;
      $maping->cookie = $encryptkey;
      $maping->save();

      return [
        'success'=>true,
        'message'=>'Successfully created'
      ];
    }
    }
    catch (Exception $e) {
      return response()->json([
          'success'=>false,
          'message' => $e->getMessage()
      ], status: 500);
  }


  }


  public function GetCookieInMap($userid) {}

  // Verify cookie db in [cookiemapings] table
  
  public function VerifyCookie($token) {
     try{
      if($token){ 
        $decrypt_token = decrypt($token);
  
        $decoded = base64_decode($decrypt_token);
  
        [$hashedId, $hmac] = explode('.', $decoded);
  
        // Verify the HMAC signature
        $expectedHmac = hash_hmac('sha256', $hashedId, env('AUTH_COOKIE'));
        if ($hmac !== $expectedHmac) {
          return [
            'success'=>false,
            'message'=>'Invalid cookie'
          ];
        }
        
        $findcookie = DB::table('cookiemapings')->where('cookie',$decrypt_token)->get();
  
        
        if(!$findcookie){
          return [
            'success'=>false,
            'message'=>'not find in db'
          ];
        }
  
        $decoded_findedcookie = base64_decode($findcookie[0]->cookie);
        [$hashid,$HMacc] = explode('.',$decoded_findedcookie);
  
        if($hashedId !== $hashid || $hmac !== $HMacc){
          return [
            'success'=>false,
            'message'=>'cookie unmatch with db cookie'
          ];
        }
         
        return [
          'success'=>true
        ];
  
  
       }
     }
     catch(Exception $e){
      return [
        'success'=>false,
        'message' => $e->getMessage(),
      ];
     }
  }
}
