<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/theme-change@2.0.2/index.js"></script>
    
    <title>Roast House - Register</title>
    
    
    
    
  </head>
  <body>
    <button title="Change Theme" data-toggle-theme="bumblebee,coffee" data-act-class="ACTIVECLASS" class="fixed z-90 bottom-10 right-8 bg-base-300 w-20 h-20 rounded-full drop-shadow-lg flex justify-center items-center text-white text-4xl">&#10024;</button>
    <div class="hero min-h-screen bg-base-200">
      <div class="hero-content text-center">
        
        <div class="card bg-base-100 shadow-xl">
          
          <div class="card-body">
            <h2 class="card-title">Roast House</h2>
            
            <form action="/register" method="post">
              <div class="form-control">
                @csrf
                
                <label class="label">
                  <span class="label-text">Name</span>
                </label>
                <div class="input-group">
                  <input type="text" name="name" class="input input-bordered w-full" />
                </div>
                
                <label class="label">
                  <span class="label-text">Username</span>
                </label>
                <div class="input-group">
                  <input type="text" name="user" class="input input-bordered w-full" />
                </div>
                
                <label class="label">
                  <span class="label-text">Password</span>
                </label>
                <div class="input-group">
                  <input type="password" name="pass" class="input input-bordered w-full" />
                </div>
                
                
                <button class="btn mt-5 bg-primary text-white">Register</button>
                @isset($error)
                <span class="text-green-500">{{$error}}</span>
                @endisset

                @foreach ($errors->all() as $error)
                <span class="text-red-500">{{ $error }}</span>
                @endforeach
              </div>
            </form>
            <div class="divider">OR</div>
            <a href="login" class="btn bg-neutral">Login to your account</a>
            
            
          </div>
        </div>
        
      </div>
    </div>
    
    
    
    
    
  </body>
</html>