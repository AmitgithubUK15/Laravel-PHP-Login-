<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    @vite('resources/css/app.css')
</head>
<body>

    <header class='w-full py-3 border'>
        <nav >
           <div class="flex flex-row justify-around">
           <div class="flex ">
                <h1 class='text-2xl font-bold'>Hi, You Login</h1>
            </div>
            <div>
                <div>
                    <button class='text-2xl font-bold text-red-500'>Logout</button>
                </div>
            </div>
           </div>
        </nav>
    </header>

     <div class="text-center p-4">
     <h1 class="text-3xl text-red-500">Hi, I am from client</h1>

     </div>
    
          
 <div>
 @if (session('useremail'))
        <p class="text-green-500">Message: {{ session('useremail') }}</p>
    @else
        <p>No message found</p>
    @endif
 </div>

  <div>
  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    
@endif
  </div>

  
</body> 
</html>
