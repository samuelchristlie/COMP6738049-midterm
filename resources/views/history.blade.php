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
    
    
    
    <div class="flex items-center justify-center w-full mb-16 mt-5">
      
      @php
      use App\Models\Coffee;
      use Carbon\Carbon;
      @endphp
      @if(count($transactions) > 0)
      <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 md:w-3/4 w-5/6">
        @foreach ($transactions as $transaction)
        @php
        $coffee = Coffee::find($transaction->coffeeId);
        @endphp
        <div class="p-4 bg-base-200 shadow-xl rounded-2xl">
          <img src="images/{{ $coffee->imageUrl }}" alt="{{ $coffee->name }}" class="w-full h-48 object-cover rounded-2xl">
          <h2 class="text-2xl font-semibold mt-2">{{ $coffee->name }}</h2>
          <p class="text-gray-500 text-lg mb-1">IDR {{ $transaction->price }}</p>


          <p class="">Bought on {{ Carbon::parse($transaction->timestamp)->isoFormat('dddd, MMMM Do YYYY');}}</p>
        </div>


        @endforeach
      </div>
      @else
      <p>No transaction history available.</p>
      @endif
      
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <div class="btm-nav">
      <a href ="home">
        <span class="material-symbols-rounded h-5 w-5">
          home
        </span>
      </a>
      <a href ="history"  class="active">
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