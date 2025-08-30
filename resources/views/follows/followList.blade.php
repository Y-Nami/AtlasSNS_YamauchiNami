<x-login-layout>

<!-- フォローユーザーアイコン一覧 -->
<section id="contentHead">
  <div class="flex_wrap">
  <h2>フォローリスト</h2>
  <ul class="flex_box flex_wrap">
    @foreach ($users as $user)
    <li class="flex_box">
      <a href="{{ url('/profile/'.$user->id) }}" class="btn_style">
        <img src="{{ asset('images/'.$user->icon_image) }}" alt="">
      </a>
    </li>
    @endforeach
  </ul>
  </div>
</section>

<!-- フォローユーザー投稿一覧 -->
<section id="followContent">
  <div>
    <ul>
      @foreach ($posts as $post)
      <li class="post_view">
        <div class="post_wrap">
          <div class="post_flex">
            <a href="{{ url('/profile/'.$post->user_id) }}">
              <img src="{{ asset('images/'.$post->user->icon_image) }}" alt="" class="user_icon">
            </a>
          </div>
          <div class="post_flex post_text">
            <p>{{ $post->user->username }}</p>
            <p>{{ $post->post }}</p>
          </div>
          <div class="post_flex post_date">
            {{ $post->created_at }}
          </div>
        </div>
      </li>
      @endforeach
    </ul>
  </div>
</section>

</x-login-layout>
