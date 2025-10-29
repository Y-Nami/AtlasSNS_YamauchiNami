<x-login-layout>

<section id="profileEdit">
  <!-- バリデーションエラーの表示 -->
  @if ($errors->any())
  <div>
    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
  </div>
  @endif

  <div class="flex_wrap">

    <div class="flex_box top user_icon">
      <img src="{{ asset('/images/'.$user->icon_image) }}" alt="">
    </div>

    <div class="flex_box">
      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
          <label>ユーザー名</label>
          <input type="text" name="username" value="{{ $user->username }}">
        </div>
        <div>
          <label>メールアドレス</label>
          <input type="text" name="email" value="{{ $user->email }}">
        </div>
        <div>
          <label>パスワード</label>
          <input type="password" name="password">
        </div>
        <div>
          <label>パスワード確認</label>
          <input type="password" name="password_confirmation">
        </div>
        <div>
          <label>自己紹介</label>
          <input type="text" name="bio" value="{{ $user->bio }}">
        </div>
        <div>
          <label>アイコン画像</label>
          <input type="file" name="icon_image" class="input_file">
        </div>
        <div class="flex_wrap">
          <input type="hidden" name="id" value="{{ $user->id }}">
          <button type="submit">更新</button>
        </div>
      </form>
    </div>

  </div>
</section>

</x-login-layout>
