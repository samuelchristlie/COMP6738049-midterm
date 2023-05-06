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
    
    <div class="flex items-center justify-center w-full px-8 md:px-10pt-5">
      @php
      use App\Models\Coffee;
      $categories = Coffee::pluck('category')->unique();
      @endphp
      <div>
        <a href="coffee" class="btn md:btn-md btn-sm ">All</a>
        @foreach($categories as $category)
        <a href="coffee-{{strtolower($category)}}" class="btn md:btn-md btn-sm ">{{$category}}</a>
        @endforeach
      </div>
    </div>
    <div class="flex items-center justify-center w-full px-8 md:px-10 pb-20 pt-5">
      
      
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 w-full mx-0 md:mx-10">
        @foreach($coffees as $coffee)
        <div class="bg-base-200 shadow-md rounded-2xl overflow-hidden shadow-xl cursor-pointer" onclick="showModal('{{ $coffee->id }}')">
          <img src="images/{{$coffee->imageUrl}}" alt="{{$coffee->name}}" class="rounded-2xl w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-semibold">{{$coffee->name}}</h3>
            <p class="text-gray-500">IDR {{$coffee->price}} </p>
          </div>
        </div>
        
        <div id="modal-{{ $coffee->id }}" class="modal">
          <form class="form-control" action="buy" method="post">
            @csrf 
            <div class="modal-box">
              <div class="modal-header">
                <button type="button" class="btn btn-ghost btn-square absolute right-2 top-2" onclick="hideModal('{{ $coffee->id }}')">X</button>
              </div>
              <div class="modal-body mt-10">
                
                <img src="images/{{$coffee->imageUrl}}" alt="{{$coffee->name}}" class=" rounded-xl w-full h-64 object-cover">
                <h2 class="text-2xl font-bold mt-4">{{$coffee->name}}</h2>
                <p class="mb-5">{{$coffee->description}}</p>
              </div>
              <div class="modal-footer text-right">
                <p class="text-gray-500 text-xl mb-2">IDR {{$coffee->price}} </p>
                <button type="button" class="btn btn-error btn-outline" onclick="hideModal('{{ $coffee->id }}')">No</button>
                
                <input type="hidden" name="coffeeId" value={{$coffee->id}}>
                <button class="btn btn-primary" onclick="hideModal('{{ $coffee->id }}')">Buy</button>
                
              </div>
            </div>
          </form>
        </div>
        @endforeach
      </div>
      
      <script>
      function showModal(coffeeId) {
      const modal = document.getElementById('modal-' + coffeeId);
      modal.classList.add('modal-open');
      }
      
      function hideModal(coffeeId) {
      const modal = document.getElementById('modal-' + coffeeId);
      modal.classList.remove('modal-open');
      }
      </script>
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <div class="btm-nav">
      <a href ="home" >
        <span class="material-symbols-rounded h-5 w-5">
          home
        </span>
      </a>
      <a href ="history">
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