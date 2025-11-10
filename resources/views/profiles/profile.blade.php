<x-login-layout>


<section id="contentHead" class="flex_wrap">
  <!-- ユーザーアイコン -->
  <div class="flex_box">
    <img src="{{ asset('/images/'.$user->icon_image) }}" alt="" class="user_icon">
  </div>

  <!-- ユーザー名・自己紹介 -->
  <div class="flex_box left">
    <div class="flex_wrap"> <!-- ユーザー名 -->
      <p class="flex_box topic_width">ユーザー名</p>
      <p class="flex_box left">{{ $user->username }}</p>
    </div>
    <div class="flex_wrap"> <!-- 自己紹介 -->
      <p class="flex_box topic_width">自己紹介</p>
      <p class="flex_box left bio">{{ $user->bio }}</p>
    </div>
  </div>

  <div class="flex_box">
    <!-- フォロー解除 -->
    @if (auth()->user()->isFollowing($user->id))
    <form action="{{ route('profile.unfollow') }}" method="POST">
      @csrf
      <input type="hidden" name="target" value="{{ $user->id }}">
      <button type="submit" class="follow_btn unfollow">フォロー解除</button>
    </form>

    <!-- フォロー -->
    @else
    <form action="{{ route('profile.follow') }}" method="POST">
      @csrf
      <input type="hidden" name="target" value="{{ $user->id }}">
      <button type="submit" class="follow_btn follow">フォローする</button>
    </form>
    @endif
  </div>

</section>

<!-- 投稿内容 -->
<section>
  <ul>
    @foreach ($posts as $post)
    <li class="flex_wrap post_view">
      <div class="flex_box">
        <img src="{{ asset('/images/'.$post->user->icon_image) }}" alt="" class="user_icon">
      </div>

      <div class="flex_box left">
        <p>{{ $user->username }}</p>
        <p>{!! nl2br(e($post->post)) !!}</p>
        <!-- <p>{{ $post->post }}</p> -->
      </div>

      <div class="flex_box top post_date">
        {{ $post->created_at->format('y-m-d H:i') }}
      </div>
    </li>
    @endforeach
  </ul>

</section>


</x-login-layout>
