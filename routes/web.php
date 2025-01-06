    <?php


use App\Http\Middleware\CheckLoginMiddleware;
use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    require __DIR__ . '/auth/auth.php';

    Route::get('/', function (Request $request) {
        return view('pages.Home');
    })
        ->name('home')
        ->middleware([CheckLoginMiddleware::class]);

    Route::get('/session', function () {
        $email = "Amit@gmail.com";
        session(['email' => $email]);
    });


        // $value = session()->all();
        // session()->flush('email');
        // echo "<pre>";
        // print_r($value);
        // echo "<pre>";

    //    $value =  session('gett')
