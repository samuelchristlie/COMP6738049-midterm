<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/theme-change@2.0.2/index.js"></script>
    
    <title>Roast House - Home</title>
    
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,500,1,0" />
    
    @php


    if ($customer->loyalty >= 1000) {
    $loyalty_level = 'Diamond';
    $mainColor = "207 90% 54%";
    } elseif ($customer->loyalty >= 500) {
    $loyalty_level = 'Platinum';
    $mainColor = "0 0% 59%";
    } elseif ($customer->loyalty >= 100) {
    $loyalty_level = 'Gold';
    $mainColor = "43 47% 58%";
    } else {
    $loyalty_level = 'Green';
    $mainColor = "156 100% 22%";
    }
    @endphp

    <style>
    :root {
    /*    --p: 156 100% 22%;*/
    
    
    --p: {{$mainColor}};
    --pc: 0 0% 95%;
    }
    </style>
    
  </head>
  <body>
    <button title="Change Theme" data-toggle-theme="bumblebee,coffee" data-act-class="ACTIVECLASS" class="fixed z-50 bottom-20 right-8 bg-base-300 w-20 h-20 rounded-full drop-shadow-lg flex justify-center items-center text-white text-4xl">&#10024;</button>
    <a href="coffee"title="Coffee" class="bg-primary fixed z-50 bottom-20 right-32 bg-base-300 w-20 h-20 rounded-full drop-shadow-lg flex justify-center items-center text-primary-content text-4xl">
      <span class="material-symbols-rounded h-5 w-5">
        coffee
      </span>
    </a>
    <div class="navbar bg-base-100">
      
      <div class="flex-1">
        <a href="home" class="btn btn-ghost normal-case text-xl"><img src="favicon-32x32.png" alt="Logo" style="transform: translateY(-4px);">Roast House</a>
      </div>
      <div class="flex-none">
        <button class="btn btn-square btn-ghost">
        <a href="logout">
          <span class="material-symbols-rounded">
            logout
          </span>
        </a>
        </button>
      </div>
    </div>
    
    <div class="flex items-center justify-center w-full">
      <div class="card w-full md:w-5/6 lg:w-3/4 bg-base-100 shadow-xl">
        <div class="card-body">
          @php
          $current_time = now();
          if ($current_time->hour >= 5 && $current_time->hour < 12) {
          $time_of_day = "morning";
          } elseif ($current_time->hour >= 12 && $current_time->hour < 18) {
          $time_of_day = "afternoon";
          } else {
          $time_of_day = "evening";
          }
          @endphp
          
          
          <h2 class="card-title text-4xl">Good {{ $time_of_day}}, {{$customer->name}}!</h2>
          <div class="badge badge-primary gap-2 px-3 py-4">
            <span class="material-symbols-rounded" style="transform: translateY(-2px);">
              star
            </span>
            {{$customer->loyalty}} Loyalty Points
          </div>
          <ul class="steps w-full">
            <li class="step step-primary" data-content="0">Green</li>
            <li class="step @if($customer->loyalty >= 100) step-primary @endif" data-content="100">Gold</li>
            <li class="step @if($customer->loyalty >= 500) step-primary @endif" data-content="500">Platinum</li>
            <li class="step @if($customer->loyalty >= 1000) step-primary @endif" data-content="1000">Diamond</li>
          </ul>
          
          <button class="btn btn-disabled">Redeem</button>
        </div>
        
      </div>
      
      
    </div>
    
    <div class="flex items-center justify-center w-full">
      <div class="card w-full md:w-5/6 lg:w-3/4 bg-base-200 mt-5">
        <div class="card-body">
          <div class="flex-col lg:flex-row">
            <div class="carousel carousel-center w-full p-4 space-x-4 bg-neutral rounded-box">
              @php
              use App\Models\Coffee;
              
              $promo1 = Coffee::where("category", "Cold Brew")->orWhere('category', 'Latte')->orWhere('category', 'Cappucino')->get();
              @endphp
              
              @foreach($promo1 as $coffee)
              <div class="carousel-item">
                <img src="images/{{$coffee->imageUrl}}" class="rounded-box h-52" />
              </div>
              @endforeach
              
            </div>
            <div>
              <h1 class="text-5xl font-bold">The best ideas start with coffee!</h1>
              <p class="py-6">Enjoy a free refill on any coffee drink at Roast House when you stay to work or study.</p>
              <a href="coffee" class="btn btn-primary">Explore</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="flex items-center justify-center w-full">
      <div class="card w-full md:w-5/6 lg:w-3/4 bg-base-200 mt-5 mb-20">
        <div class="card-body">
          <div class="flex-col lg:flex-row">
            <div class="carousel carousel-center w-full p-4 space-x-4 bg-neutral rounded-box">
              @php              
              $promo2 = Coffee::where("category", "Espresso")->orWhere('category', 'Cappucino')->orWhere('category', 'Latte')->get();
              @endphp
              
              @foreach($promo2 as $coffee)
              <div class="carousel-item">
                <img src="images/{{$coffee->imageUrl}}" class="rounded-box h-52" />
              </div>
              @endforeach
              
            </div>
            <div>
              <h1 class="text-5xl font-bold">Espresso yourself!</h1>
              <p class="py-6">Try any of our espresso drinks for half price at Roast House this month.</p>
              <a href="coffee" class="btn btn-primary">Explore</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <div class="btm-nav">
      <a href ="home" class="active">
        <span class="material-symbols-rounded h-5 w-5">
          home
        </span>
      </a>
      <a href ="history" >
        <span class="material-symbols-rounded h-5 w-5">
          history
        </span>
      </a>
    </div>
    
    <footer class="footer p-10 bg-base-200 mb-10">
      <div>
        <img src="icon.png" width="72" height="72"/>
        <p><span class="text-lg font-bold">Roast House Corp.</span><br/>Brewing happiness, one cup at a time</p>
      </div>
      <div>
        <span class="footer-title">Social</span>
        <div class="grid grid-flow-col gap-4">
          <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path></svg></a>
          <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path></svg></a>
          <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path></svg></a>
        </div>
      </div>
    </footer>
  </body>
</html>