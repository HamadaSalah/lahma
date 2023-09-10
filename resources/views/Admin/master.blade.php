@include('Admin.layouts.header')
    @include('Admin.layouts.sidebar')
    <div class="container-fluid py-4 px-5">
        @include('Admin.layouts.messages')
        @yield('content')
    </div>
@include('Admin.layouts.footer')
