<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">

@include('admin.includes.login-head')

<body>
<!-- App Start-->
<div id="root">
    <!-- App Layout-->
    <div class="app-layout-blank flex flex-auto flex-col h-[100vh]">
        <main class="h-full">

            @yield('content')

        </main>
    </div>
</div>

</body>
</html>
