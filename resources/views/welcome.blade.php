<x-app-layout>

    <!-- <h4 class="mt-5 mx-auto"> Heads up: </h4>
    <p>
        This app was made in the last 6.5 hours due to inavailablity of the laptop.
        Even though I am submitting this incomplete website. I will continue and submit the complete website in a day as well.
    </p> -->

    @auth
    <h4 class="mt-5 mx-auto"> You are Already Logged in, Goto <a href="{{ url('/dashboard') }}">Dashboard</a> </h4>
    @else

    @if($new_app)

    <!-- Admin -->
    <div class="card border-primary mb-3 mx-auto col-xs-12 col-md-8">
        <div class="card-header bg-primary text-white text-center"> Welcome to your New App Admin! </div>
        <div class="card-body">
            <p class="card-text">Set Up Admin login credentials for this website.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Username -->
                <div class="control-group my-2">
                    <label class="control-label" for="name">Username</label>
                    <div class="controls">
                        <input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="control-group my-2">
                    <label class="control-label" for="email">Email</label>
                    <div class="controls">
                        <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required>
                    </div>
                </div>

                <!-- Password -->
                <div class="control-group my-2">
                    <label class="control-label" for="password"> Password </label>
                    <div class="controls">
                        <input id="password" class="block mt-1 w-full" type="password" name="password" required>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="control-group my-2">
                    <label class="control-label" for="password_confirmation">Confirm Password </label>
                    <div class="controls">
                        <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end mt-4">
                    <x-button class="ml-4 btn btn-primary">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>

            <!-- Validation Errors -->
            <!-- <div style="color: red;">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div> -->

        </div>
    </div>

    @else

    <!-- User -->
    <div class="card border-primary mb-3 mx-auto col-xs-12 col-md-8">
        <div class="card-header bg-primary text-white text-center"> Welcome! </div>
        <div class="card-body">
            <p class="card-text">Please Log in first to see the dashboard.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="control-group my-2">
                    <label class="control-label" for="email">Email</label>
                    <div class="controls">
                        <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus>
                    </div>
                </div>

                <!-- Password -->
                <div class="control-group my-2">
                    <label class="control-label" for="password"> Password </label>
                    <div class="controls">
                        <input id="password" class="block mt-1 w-full" type="password" name="password" required>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="d-flex align-items-center justify-content-end mt-4">
                    <x-button class="ml-4 btn btn-primary">
                        {{ __('Login') }}
                    </x-button>
                </div>
            </form>

            <!-- Validation Errors -->
            <!-- <div style="color: red;">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div> -->

        </div>
    </div>

    @endif

    @endauth


</x-app-layout>