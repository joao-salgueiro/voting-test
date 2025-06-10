<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo / Nome do App -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('polls.index') }}" class="text-gray-700 hover:text-indigo-600">
                        Polls
                    </a>
                </div>

                <!-- Links públicos -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="{{ route('polls.index') }}" class="text-gray-700 hover:text-indigo-600">
                        Polls
                    </a>
                    @auth
                        {{-- <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600"> --}}
                            Dashboard
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Direita (usuário) -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <!-- Nome do usuário -->
                    <span class="mr-4 text-gray-700">
                        Hello, {{ Auth::user()->name }}
                    </span>

                    <!-- Botão de logout -->
                    {{-- <form method="POST" action="{{ route('logout') }}"> --}}
                        @csrf
                        <button class="text-red-600 hover:text-red-800" type="submit">
                            Logout
                        </button>
                    </form>
                @else
                    <!-- Login/Register -->
                    {{-- <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 mr-4"> --}}
                        Login
                    </a>
                    {{-- <a href="{{ route('register') }}" class="text-gray-700 hover:text-indigo-600"> --}}
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>