    <?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    require __DIR__ . '/auth/auth.php';

    Route::get('/', function (Request $request) {
        // $value = session()->all();
        // session()->flush('email');
        // echo "<pre>";
        // print_r($value);
        // echo "<pre>";
        return view('pages.Home');
    })->name('home');

    Route::get('/session', function (){
        $email = "Amit@gmail.com";
        session(['email'=>$email]);
    });


