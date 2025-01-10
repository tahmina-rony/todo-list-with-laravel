<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To Do List</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">



  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <nav class="bg-gray-800 text-white">
    <div class="container mx-auto px-4 flex justify-between items-center py-4">
      <!-- Logo -->
      <a href="{{route('home')}}" class="text-xl font-bold">MY TODO</a>

         <!-- Search Bar -->
         <div class="flex items-center flex-1 max-w-md px-4">
            <div class="relative w-full">
                <input type="text"
                       class="w-full bg-gray-600 text-white placeholder-gray-300 rounded-lg px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Search...">
                <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
      <!-- Menu -->
      <div class="hidden md:flex space-x-6">
        <a href="#" class="hover:text-gray-300">Home</a>
        <a href="#" class="hover:text-gray-300">About</a>
        <a href="#" class="hover:text-gray-300">Services</a>
        <a href="#" class="hover:text-gray-300">Contact</a>
      </div>

      <!-- Mobile Menu Button -->
      <button id="menu-btn" class="md:hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
      </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden flex flex-col space-y-4 bg-gray-700 py-4 px-4">
      <a href="#" class="hover:text-gray-300">Home</a>
      <a href="#" class="hover:text-gray-300">About</a>
      <a href="#" class="hover:text-gray-300">Services</a>
      <a href="#" class="hover:text-gray-300">Contact</a>
    </div>
  </nav>
  <section class="py-5 bg-gray-100">
    <div class="container mx-auto px-4">
        <h4 class="text-right text-xl text-green-700">{{session('text')}}</h4>
        <h2 class="text-2xl font-bold text-gray-700 mb-6 text-center">Add a New Task</h2>
        <form action="{{route('store')}}" method="post">
            @csrf
        <div class="flex items-center max-w-md mx-auto">
            <input type="text" name="task"
                   class="w-full bg-gray-600 text-white placeholder-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Enter your task...">

            <button class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300" type="submit">
                Add
            </button>
        </div>
        <br/>
        <div class="flex items-center max-w-md mx-auto">
            @error('task')
            <span class="text-red-600 text-justify">{{ $message }}</span>
            @enderror
        </div>

    </form>
    </div>
  </section>
  <section class="py-5 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-700 mb-6 text-center">My ToDo List</h2>

        <form action="{{route('search')}}" method="get">
            @csrf
            <div class="flex justify-end my-3">
                <input type="text" class="border rounded-lg pl-4 pr-2 py-2" placeholder="Search..." name="search" value="{{@$search}}">
                <button class="bg-red-400 hover:bg-red-500 text-white rounded-lg px-4 py-2" type="submit">Search</button>
            </div>
        </form><!-- Search Form -->
        <form action="{{route('delete.multiple')}}" method="post">
            @csrf
            <button class=" flex justify-start bg-red-600 my-1 hover:bg-red-500 text-white p-2 rounded"><i class="fas fa-trash text-white-500 cursor-pointer"></i></button>


            <div class="flex justify-end">

            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Select</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SL NO</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ( $todos as $todo)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" name="ids[]"  value="{{$todo->id}}">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $todo->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $todo->task }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a
                        href="{{route('edit')}}"
                        class="inline-block px-3 py-1 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-md"
                        ><i class="fas fa-edit text-white-500 cursor-pointer"></i>
                        </a>
                        <a
                        href="#"
                        class="inline-block px-3 py-1 bg-red-500 text-white font-semibold rounded-lg hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-md"
                        ><i class="fas fa-trash text-white-500 cursor-pointer"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </form>
        <div class="flex justify-center py-3">
            {{ $todos->links()}}
        </div>
    </div>
  </section>
  <section class="py-5"></section>


  {{-- <footer class="fixed bottom-0 left-0 w-full bg-gray-800 text-white text-center py-4">
    <div class="container mx-auto px-6 py-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="mb-8 md:mb-0">
                <h3 class="text-2xl font-bold text-white mb-4">My Todo</h3>
                <p class="mb-4">Making the world a better place through innovative solutions.</p>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-white transition-colors"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="hover:text-white transition-colors"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="hover:text-white transition-colors"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-white transition-colors"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Services</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Projects</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Services</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white transition-colors">Web Design</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Development</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Marketing</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Contact Us</h4>
                <ul class="space-y-2">
                    <li class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        123 Street Name
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone mr-2"></i>
                        +1 234 567 8900
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-2"></i>
                        info@example.com
                    </li>
                </ul>
            </div>
        </div>
    </div>

  </footer> --}}

  <script>
    // Toggle mobile menu
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });

  </script>


</body>
</html>
