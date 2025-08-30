<x-login-layout>

  <section id="contentHead" class="new_post_wrap"> <!-- 投稿フォーム -->
    <div class="post_flex">
      <img src="{{ asset('images/'.$user->icon_image) }}" alt="user_icon">
    </div>
    <div class="post_flex">
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
          <textarea name="post" id="post" placeholder="投稿内容を入力してください。" required></textarea>
          <a href="#" id="newPostSubmit"><img src="{{ asset('images/post.png') }}" alt="" class="marks"></a>
        </div>
      </form>
    </div>
  </section>

  <section id="postView"> <!-- 投稿内容の表示 -->
    <ul>
      @foreach ($posts as $post)
      <li class="post_view">
        <div class="post_wrap">
          <div class="post_flex">
            <img src="{{ asset('images/'.$post->user->icon_image) }}" alt="" class="user_icon">
          </div>
          <div class="post_flex post_text">
            <p>{{ $post->user->username }}</p>
            <p>{{ $post->post }}</p>
          </div>
          <div class="post_flex post_date">
            {{ $post->created_at }}
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
                  <div class="modal-footer">
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
