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
        <div class="flex_wrap input_profile">
          <label>ユーザー名</label>
          <input type="text" name="username" value="{{ $user->username }}">
        </div>
        <div class="flex_wrap input_profile">
          <label>メールアドレス</label>
          <input type="text" name="email" value="{{ $user->email }}">
        </div>
        <div class="flex_wrap input_profile">
          <label>パスワード</label>
          <input type="password" name="password">
        </div>
        <div class="flex_wrap input_profile">
          <label>パスワード確認</label>
          <input type="password" name="password_confirmation">
        </div>
        <div class="flex_wrap input_profile">
          <label>自己紹介</label>
          <input type="text" name="bio" value="{{ $user->bio }}">
        </div>
        <div class="flex_wrap input_profile">
          <label>アイコン画像</label>
          <div class="flex_box file_upload">
            <input type="file" name="icon_image" class="input_file">
          </div>
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
