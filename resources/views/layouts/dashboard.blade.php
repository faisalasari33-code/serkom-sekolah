<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'dashboard')</title>

    @include('template.styles')
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('template.sidebar')

            <div class="layout-page">
                @include('template.navbar')

                <div class="content-wraper">
                    <div class="container-xxl flex-grow-1 container-p-y">

                        @yield('content')   
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('template.script')
</body>
</html>