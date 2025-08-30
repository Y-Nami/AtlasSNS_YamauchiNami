// header menu ----------
$(function () {
  $('.head_trigger').click(function () {
    $(this).toggleClass('active');
    if ($(this).hasClass('active')) {
      $('.head_menulist').addClass('active');
      $('.tri_mark1').addClass('hidden');
      $('.tri_mark2').removeClass('hidden');
    } else {
      $('.head_menulist').removeClass('active');
      $('.tri_mark1').removeClass('hidden');
      $('.tri_mark2').addClass('hidden');
    }
  });
  $('.head_menulist ul li a').click(function () {
    $('.head_trigger').removeClass('active');
    $('.head_menulist').removeClass('active');
  });
});

// logout ----------
$(function () {
  $('#logoutSubmit').on('click', function (e) {
    e.preventDefault(); // デフォルトのリンク動作をキャンセル
    $('#logoutForm').submit(); // フォームを送信
  });
});

// new post ----------
$(function () {
  $('#newPostSubmit').on('click', function (e) {
    e.preventDefault(); // デフォルトのリンク動作をキャンセル
    $('#newPost').submit(); // フォームを送信
  });
});
