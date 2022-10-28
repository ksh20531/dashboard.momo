<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://kit.fontawesome.com/d4028f6215.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

    @yield('style')
    <style type="text/css">
        /*common*/
        #app{

            /*max-width: 1080px;*/
        }

        /*header*/
        header{
            position: fixed;
            top: 0;
            width: 100%;
            height: 80px;
            background-color: white;
            z-index: 9999;
        }
        .header-area{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            height: 80px;
            margin: 0px 50px 0px 50px;
            border-bottom: 1px solid #108488;

        }
        .logo-area{
            display: inline-block;
            white-space: 200px;
            height: auto;
        }
        .logo-img{
            width: 150px;
        }
        .menu-item{
            list-style-type: none; 
            float: left;
            margin-right: 50px;
            width: 40px;
        }
        .menu-item-icon{
            color: #108488;
        }
        .noti{

        }
        .avatar{
            display: inline-block;
        }
        .dropdown-menu[data-bs-popper]{
            left: -130px;
        }
        .btn.show{
            border: none;
        }

        /*main*/
        .container{
            position: relative;
            min-width: 1200px;
            max-width: 1580px;
            min-height: calc(100vh - 130px);
            margin: 105px 50px 0px 50px;
        }
        .page-title{
            margin: 0px 0px 10px 0px;
        }
        
        /*modal*/
        .modal{
            top: calc(50% - 80px);
        }

        /*footer*/
        footer{
            position: relative;
            bottom: 0;
            width: 100%;
            height: 25px;
            background-color: #108488;
        }
    </style>
</head>
<body>
    <div id="app">
        <header>
            <div class="header-area">
                <div class="logo-area">
                    <a href="/"><img class="logo-img" src="/img/momo_logo.png" alt="MOMO"></a>
                </div>
                <div class="menu-area" style="display:inline-block;">
                    <ul class="menu">
                        <li class="menu-item"><a href="{{ env("APP_URL") }}/dashboard"><i class="fa-regular fa-clipboard fa-2x menu-item-icon"></i></a></li>
                        <li class="menu-item"><a href="{{ env("APP_URL") }}/talk"><i class="fa-regular fa-comments fa-2x menu-item-icon"></i></a></li>
                    </ul>
                </div>
                <nav class="nav-area" style="display: inline-block; padding: 0px;">
                    <div class="navbar navbar-expand-md navbar-light" style="padding: 0px;">
                        <div class="noti">
                            {{-- <i class="fa-solid fa-bell"></i> --}}
                        </div>
                        <div class="avatar">
                            <div class="dropdown">
                                <button class="btn btn-avatar" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user fa-2x menu-item-icon"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    @guest
                                    <li><a class="dropdown-item" href="/register">회원가입</a></li>
                                    <li><a class="dropdown-item" href="/login">로그인</a></li>

                                    @else
                                    <li><a class="dropdown-item" href="/account">내정보</a></li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">로그아웃</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <main class="container">
            <div class="page-title">
                <h3>
                    @yield('title')
                </h2>
            </div>
            <div class="page-wrapper">
                @yield('content')    
            </div>
        </main>
        <footer>
            <div style="text-align: center;">ⓒ {{ date("Y") }}. ksh20531@naver.com. All Rights Reserved.</div>
        </footer>
        
    </div>
    <div class="modal fade" id="popupModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"></div>
                <div class="modal-body" id="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btn-positive"></button>
                    <button type="button" class="btn btn-primary" id="btn-negative"></button>
                </div>
            </div>
        </div>
    </div>


    @yield('script')
    <script type="text/javascript">
        $('#btn-negative').click(function(){
            $("#popupModal").modal('hide');
        });
    </script>
</body>
</html>
