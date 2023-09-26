<div class="header">
    <nav class="navbar navbar-expand-lg navbar-light  ">
        <div class="container">
            <div class="logo">
                <a class="navbar-brand m-bold" href="{{ Route('index') }}" style="font-weight: bold;">
                    <img src="{{asset('img/logo.png')}}" alt="" width="200px">    
                </a>
                
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="{{ Route('index') }}">الرئيسية</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a  class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" >التصنيفات</a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            @if (allCats())
                                @foreach (allCats() as $caat)
                                    <li><a class="dropdown-item" href="{{Route('category', $caat->id)}}">{{$caat->name}}</a></li>
                                @endforeach
                            @endif
                        </ul>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{Route('products')}}">المنتجات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#footer">حمل التطبيق</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{Route('contactus')}}">اتصل بنا</a>
                    </li>
                    <li class="nav-item">
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{Route('login')}}">تسجيل الدخول</a>
                    </li>
                        
                    @endguest

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item" href="{{Route('orders')}}">الطلبات</a></li>
                            </ul>
                        </li>

                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ Route('mycard') }}"><i
                                class="fa-solid fa-cart-shopping"></i>
                            @if(cartCount())
                                <span id="cartCount">{{ cartCount() }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
