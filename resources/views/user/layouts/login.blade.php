<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">

@include('user.includes.login-head')

<body>
<!-- App Start-->
<div id="root">
    <!-- App Layout-->
    <div class="app-layout-blank flex flex-auto flex-col h-[100vh]">
        <div class="h-full flex flex-auto flex-col justify-between">
            <main class="h-full">
                <div class="page-container relative h-full flex flex-auto flex-col">
                    <div class="grid lg:grid-cols-3 h-full">
                        <div class="bg-no-repeat bg-cover py-6 px-16 flex-col justify-between hidden lg:flex"
                             style="background-image: url('frontend/assets/img/others/auth-side-bg.jpg');">
                            <div class="logo">
                                <h2 style="color: #fff;">LMGAS</h2>
                            </div>
                            <div>
                                <img class="avatar-img avatar-circle"
                                     src="{{asset('frontend/assets/img/others/Login-rafiki.png')}}" loading="lazy">
                            </div>
                            <span class="text-white">Copyright © 2023
                                <span class="font-semibold">Mjnamdi</span>
                            </span>
                        </div>
                        <div class="col-span-2 flex flex-col justify-center items-center bg-white dark:bg-gray-800">

                            @yield('content')

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

</body>
</html>
