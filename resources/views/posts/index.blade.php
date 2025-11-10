<x-login-layout>

  <section id="contentHead" class="flex_wrap"> <!-- 投稿フォーム -->
    <div class="flex_box top">
      <img src="{{ asset('images/'.$user->icon_image) }}" alt="user_icon">
    </div>
    <div class="flex_box left">
      <form id="newPost" action="{{ route('posts.store') }}" method="POST">
        @csrf
        @if ($errors->any())
        <div>
          <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <div class="input_row">
          <textarea name="post" id="post" placeholder="投稿内容を入力してください。" wrap="soft" required></textarea>
          <a href="#" id="newPostSubmit"><img src="{{ asset('images/post.png') }}" alt="" class="marks"></a>
        </div>
      </form>
    </div>
  </section>

  <section id="postView"> <!-- 投稿内容の表示 -->
    <ul>
      @foreach ($posts as $post)
      <li class="post_view">
        <div class="flex_wrap">
          <div class="flex_box">
            <img src="{{ asset('images/'.$post->user->icon_image) }}" alt="" class="user_icon">
          </div>

          <div class="flex_box left">
            <p>{{ $post->user->username }}</p>
            <p>{!! nl2br(e($post->post)) !!}</p>
            <!-- <p>{{ $post->post }}</p> -->
          </div>

          <div class="flex_box top post_date">
            {{ $post->created_at->format('y-m-d H:i') }}
          </div>
        </div>
        @if ($user->id == $post->user->id)
        <div class="post_marks">
          <!-- edit button -->
          <div class="flex_box">
            <button class="btn_style" data-toggle="modal" data-target="#editModal">
              <img src="{{ asset('images/edit.png') }}" alt="" class="marks">
            </button>
          </div>
          <!-- edit modal -->
          <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <form class="modal-body" id="editPost" action="{{ route('posts.edit') }}" method="POST">
                @csrf
                <div class="modal-content">
                  <div class="modal-body">
                    <textarea name="post_edit" id="postEdit" required>{{ $post->post }}</textarea>
                    <input type="hidden" name="id_edit" value="{{ $post->id }}">
                  </div>
                  <div class="modal-footer flex_wrap">
                    <button type="submit" class="btn_style">
                      <img src="{{ asset('images/edit.png') }}" alt="">
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- trash button -->
          <div class="flex_box">
            <form action="{{ route('posts.delete') }}" method="POST" onsubmit="return confirm('この投稿を削除します。よろしいでしょうか？')">
              @csrf
              <input type="hidden" name="id" value="{{ $post->id }}">
              <button type="submit" class="btn_style">
                <div class="trash_hover"></div>
              </button>
            </form>
          </div>
        </div>
        @endif
      </li>
      @endforeach
    </ul>
  </section>

</x-login-layout>
