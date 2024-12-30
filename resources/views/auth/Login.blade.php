<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class='w-full h-full'>
       <div class='w-full h-full  flex justify-center items-center'>

          <div class='w-72 border shadow-lg rounded-md'>
            
            <div class='py-5 px-3 flex flex-col gap-4'>
              <!-- {/* loging header */} -->
              <div class='text-center'>
                <h1>
                  <span class='font-bold text-4xl'>
                    Login
                  </span>
                </h1>
              </div>

               <!-- {/* login form */} -->
               <div>
                    <div>
                      <form action="/auth/Signin" method="post" class='flex flex-col gap-5'>
                        <!-- {/* name */} -->
                    
                        <!-- {/* email */} -->
                        <div>
                          <label for="email" className='text-sm font-semibold'>Email </label> <br />
                          <input type="email" name="email" class='outline-none text-md border-b border-black  w-full py-2 px-1'
                           placeholder='Enter Your Email...' required 
                           />
                        </div>
                         
                         <!-- {/* password */} -->
                        <div>
                        <label for="password" class='text-sm font-semibold'>Password</label> <br />
                          <input type="password" name="password" class='outline-none text-md border-b border-black  w-full py-2 px-1'
                          name="" id=""  placeholder='Enter Your Password...' required 
                           />
                        </div>

                        <!-- {/* Login button */} -->
                        <div class=' rounded-md overflow-hidden'>
                          <div class='w-full bg-black'>
                          <button type='submit' class='border w-full text-white p-3 text-md font-semibold'>Signup</button>
                          </div>
                        </div>
                      </form>
                    </div>
               </div>
               
               <!-- {/* error */} -->
               <div class='h-6'>
                 <!-- <ErrorHandler /> -->
               </div>
               
               <!-- {/* login with google and facebook */} -->

               <div >
                  <div class='flex flex-col gap-3 '>
                    <div class='text-center text-md'>
                    <h3>Signup</h3>
                    </div>

                    <div class='flex justify-center'>
                     <OAuth />
                    </div>
                  </div>
                </div>

            </div>

          </div>

       </div>
    </div>
</body>
</html>
