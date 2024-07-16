@extends('layouts.app')

{{-- @section('content') --}}

<div class="h-screen fixed w-3/5 -top-10 md:top-20 -left-96 md:left-0 opacity-20 blur-md">
    <div class="line3"></div>
    <div class="line4"></div>
    <div class="line2"></div>
    <div class="line1"></div>
</div>
<div class="bg-gray-100 ">
        <div class=" fixed z-40 w-full">
            <div class="relative container mx-auto">
                <div class="flex justify-center mt-6">
                    <img class="h-28 w-28 rounded-full" src="/imgs/ULS.jpg">
                </div>
            </div>
        </div>
    <div class="container mx-auto relative">
        <div class="h-screen flex justify-center items-center">
            <div>
                <div class="flex gap-3">
                    <div>
                        <img class="h-20" src="//mmsu.edu.ph//mmsu_logo/mmsu_logo.png"/>
                    </div>
                    <div class="flex items-center" style="font-family: 'Adobe Garamond Pro'">
                        <div>
                            <span class="font-semibold text-2xl sm:text-3xl text-gray-600 ">Mariano Marcos State University</span> <br>
                            <span class="text-gray-500 ">University Library System</span>
                        </div>
                    </div>
                </div>

                <div class="card mt-3 p-5 backdrop-blur-md bg-white/70 ">


                    <h5>ACCOUNT Test</h5>

                    <div class="p-5">
                        <form method="POST" class="flex flex-col gap-6" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="w-full">
                                {{-- <label for="email">Email</label> --}}
                                <div class="w-full">
                                    <input id="username" type="text" placeholder="username"  class="form-input w-full border border-gray-300 rounded @if($errors->has('username')) border-2 border-red-600 @endif" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus />
                                </div>

                                @if($errors->has('username'))
                                    <span class="text-red-600" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="w-full">
                                {{-- <label for="password">Password</label> --}}
                                <div class="w-full">
                                    <input id="password" type="password" placeholder="Password"  class="form-input w-full border border-gray-300 rounded" name="password" required autocomplete="current-password"/>
                                </div>
                            </div>


                            <div class="w-full flex -my-2 -py-2">
                                <div class="flex-grow ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full grid">
                                <div class="place-self-center">
                                    <button class="btn btn-primary" type="submit">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
{{-- @endsection --}}
