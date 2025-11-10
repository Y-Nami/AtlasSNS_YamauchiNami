        <div id="head">
            <h1 id="headLogo">
                <a href="/top"><img src="/images/atlas.png"></a>
            </h1>
            <div id="headUser">
                <div class="head_menu">
                    @auth
                    {{ $user->username }}　さん
                    @endauth
                    @guest
                    ゲストユーザー　さん
                    @endguest
                </div>
                <div class="head_menu">
                    <div class="head_trigger">
                        <i class="fas fa-angle-down tri_mark1"></i>
                        <i class="fas fa-angle-up tri_mark2 hidden"></i>
                    </div>
                    <nav class="head_menulist">
                        <ul>
                            <li><a href="/top">HOME</a></li>
                            <li><a href="/profile ">プロフィール編集</a></li>
                            <li>
                                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="#" id="logoutSubmit">ログアウト</a>
                                </form>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="head_menu user_icon">
                    <img src="{{ asset('/images/'.$user->icon_image)}}" alt="usericon" class="user_icon">
                </div>
            </div>
        </div>
