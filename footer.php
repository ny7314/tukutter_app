<footer id="footer">
  Copyright <a href="index.php">tukutter</a>. All Rights Reserved.
</footer>
  
<script src="js/vendor/jquery-2.2.2.min.js"></script>
<script>
  $(function(){
    var $ftr = $('#footer');
    if( window.innerHeight > $ftr.offset().top + $ftr.outerHeight() ){
      $ftr.attr({'style': 'position:fixed; top:' + (window.innerHeight - $ftr.outerHeight()) +'px;' });
    }
    //メッセージ表示
    var $jsShowMsg = $('#js-show-msg');
    var msg = $jsShowMsg.text();
    if(msg.replace(/^[\s　]+|[\s　]+$/g, "").length){
      $jsShowMsg.slideToggle('slow');
      setTimeout(function(){
        $jsShowMsg.slideToggle('slow');
      }, 5000);
    }
    //画像ライブプレビュー
    var $dropArea = $('.area-drop');
    var $fileInput = $('.input-file');
    $dropArea.on('dragover', function(e){
      e.stopPropagation();
      e.preventDefault();
      $(this).css('border', '3px #ccc dashed');
    });
    $dropArea.on('dragleave', function(e){
      e.stopPropagation();
      e.preventDefault();
      $(this).css('border', 'none');
    });
    $fileInput.on('change', function(e){
      $dropArea.css('border', 'none');
      var file = this.files[0],
      $img = $(this).siblings('.prev-img'),
      fileReader = new FileReader();
      fileReader.onload = function(event){
        $img.attr('src', event.target.result).show();
      };
      fileReader.readAsDataURL(file);
    });
    //テキストエリアカウント
    var $countUp = $('#js-count'),
    $countView = $('#js-count-view');
    $countUp.on('keyup', function(e){
      $countView.html($(this).val().length);
    });
    //画像切り替え
    var $switchImgSubs = $('.js-switch-img-sub'),
    $switchImgMain = $('#js-switch-img-main');
      $switchImgSubs.on('click', function(e){
        $switchImgMain.attr('src', $(this).attr('src'));
    });
    
     //お気に入り登録・削除
     var $like, likeRecipeId;
     $like = $('.js-click-like') || null;

     likeRecipeId = $like.data('recipe_id') || null;
     //数値の０はfalseと判定されてしまう。recipe_idが０の場合もあり得るので、０もtrueとする場合にはundefinedとnullを判定する
     if(likeRecipeId !== undefined && likeRecipeId !== null){
       $like.on('click',function(){
         var $this = $(this);
         $.ajax({
           type: "POST",
           url: "ajaxLike.php",
           data: { recipe_id : likeRecipeId}
         }).done(function(data){
           console.log('Ajax Success');
           //クラス属性をtoggleでつけ外しする
           $this.toggleClass('active');
         }).fail(function(msg){
           console.log('Ajax Error');
         });
       });
     }


  });
</script>

  </body>
</html>