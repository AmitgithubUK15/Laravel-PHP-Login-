<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Student;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
     
    // Signupapi controller function
    public function Signupfunction(Request $request)
    {
        try {
            $randomnum = rand(100,1000);
            $hashrandom = hash('md2',$randomnum);
            $student = new Student();
            $student->userid = $hashrandom;
            $student->name = $request->input('name');
            $student->email = $request->input('email');
            $student->password = Hash::make($request->input('password'));
            $student->save();

            if ($student) {
                session(['roll'=>'create']);
                return redirect()->route('auth.login');
                //    response()->json([
                //     'message' => 'Student created successfully'
                //    ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], status: 500);
        }
    }
     
    // Signin api controller function
    public function SigninFunction(Request $request)
    {
     
        try {
            $email = $request->input('email');
            $user = Student::where('email',$email)->first();
            $password = Hash::check($request->input('password'),$user->password);
            
            if(!$user){
                return redirect()->route('login')->with([
                    'error' => 'Invalid email'
                ]);
            }
            
            if(!$password){
                return redirect()->route('login')->with([
                    'error'=> 'Invalid password'
                ]);
            }
        
            if($user && $password){
              return  redirect()->route('createsession',['userid'=>$user->userid]);
            }
        }
        catch (Exception $e) {
           return response()->json([
            'error' => $e->getMessage()
           ],status:500);
        }
    }

    //createsession api for create session  and setcookie in db controller function

    public function Sessionfunction($userid,Response $response)
    {
    session(['userId'=>$userid]);
    // Hash user ID for extra security
    $hashedid = hash('sha256',$userid);
     
    // Add an HMAC signature
    $hmac = hash_hmac('sha256',$hashedid, env('AUTH_COOKIE'));  // Tamper-proof signature
    
    // Combine hashed ID and HMAC
    $cookievalue = base64_encode("$hashedid.$hmac");
     
    $encryptkey = encrypt($cookievalue);
    // Create the cookie
    $cookie = cookie('user',$encryptkey,60 );
    
    
    $Pass_data_from_cookiesetter = new Helpers();
    $flag = $Pass_data_from_cookiesetter->SetCookieinMap($userid,$cookievalue);
    
     if($flag['success']){
       return redirect('/')
        ->withCookie($cookie)
        ->with('success', 'Session created successfully!');
     }
     else{
       return $flag;
     }
    }

    // signout api controller function 
    
    public function SignoutFunction(Request $request){
    //    $request->session()->forget('user');
      echo $request;
    }
}

