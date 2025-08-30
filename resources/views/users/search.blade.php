<x-login-layout>

<!-- 検索ボックス -->
<section id="contentHead">
  <!-- search box -->
   <form action="/search" method="post">
    @csrf
    <input type="text" name="keyword" placeholder="ユーザー名">
    <button type="submit" class="btn_style">
      <img src="{{ asset('images/search.png') }}" alt="" class="marks">
    </button>
  </form>
  <!-- search word -->
   @if (!empty($keyword))
   <p>{{ $keyword }}</p>
   @endif

</section>

<!-- ユーザー一覧表示 -->
<section id="searchContent">
  @foreach ($users as $user)
  <div class="flex_wrap search_wrap">
    <div class="flex_box">
      <img src="{{ asset('images/'.$user->icon_image) }}" alt="" class="user_icon">
    </div>
    <div class="flex_box left">{{ $user->username }}</div>
    @if (auth()->user()->isFollowing($user->id))
    <form action="{{ route('users.unfollow') }}" method="POST">
      @csrf
      <input type="hidden" name="target" value="{{ $user->id }}">
      <div class="flex_box"><button type="submit" class="follow_btn unfollow">フォロー解除</button></div>
    </form>
    @else
    <form action="{{ route('users.follow') }}" method="POST">
      @csrf
      <input type="hidden" name="target" value="{{ $user->id }}">
      <div class="flex_box"><button type="submit" class="follow_btn follow">フォローする</button></div>
    </form>
    @endif
  </div>
  @endforeach
</section>

</x-login-layout>
