<x-logout-layout>

  <!-- 適切なURLを入力してください -->
  {!! Form::open(['url' => 'login']) !!}

  <p>AtlasSNSへようこそ</p>

  {{ Form::label('メールアドレス') }}
  {{ Form::text('email',null,['class' => 'input']) }}
  {{ Form::label('パスワード') }}
  {{ Form::password('password',['class' => 'input']) }}

  {{ Form::submit('ログイン',['class' => 'btn']) }}

  <p class="link"><a href="register">新規ユーザーの方はこちら</a></p>

  {!! Form::close() !!}

</x-logout-layout>
