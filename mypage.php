<?php
//共通変数・関数ファイルを読み込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug(' マイページ ');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//ログイン認証
require('auth.php');

//画面表示用データ取得

$u_id = $_SESSION['user_id'];
// DBからレシピデータを取得
$recipeData = getMyRecipes($u_id);
// DBからお気に入りデータを取得
$likeData = getMyLike($u_id);
// DBからきちんとデータが全てとれているかのチェックは行わず、取れなければ何も表示しないことにする。
debug('取得したレシピデータ：'.print_r($recipeData,true));
debug('取得したお気に入りデータ：'.print_r($likeData,true));
debug('画面表示処理終了 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<?php
$siteTitle = 'マイページ';
require('head.php');
?>


<body class="page-mypage page-2colum page-logined">

  <!-- メニュー -->
  <?php
  require('header.php');
  ?>

  <p id="js-show-msg" style="display: none;" class="msg-slide">
  <?php echo getSessionFlash('msg_success'); ?>
  </p>
  

  <!-- メインコンテンツ -->
  <div id="contents" class="site-width">

    <h1 class="page-title">マイページ</h1>
    <!-- Main -->
    <section id="main">
      <section class="list panel-list">
        <h2 class="title">
          レシピ一覧
        </h2>
        <?php
        if(!empty($recipeData)):
          foreach($recipeData as $key => $val):
        ?>
        <a href="uploadRecipe.php<?php echo (!empty(appendGetParam())) ? appendGetParam().'&r_id='.$val['id'] : '?r_id='.$val['id']; ?>" class="panel">
          <div class="panel-head">
            <img src="<?php echo showImg(sanitize($val['pic1'])); ?>" alt="<?php echo sanitize($val['recipe_name']); ?>">
          </div>
          <div class="panel-body">
            <p class="panel-title"><?php echo sanitize($val['recipe_name']); ?>
            </p>
          </div>
        </a>
        <?php
        endforeach;
      endif;
        ?>
      </section>

      <section class="list panel-list">
        <h2 class="title" style="margin-bottom:15px;">
          お気に入り一覧
        </h2>
        <?php
        if(!empty($likeData)):
        foreach($likeData as $key => $val):
        ?>
        <a href="recipeDetail.php<?php echo (!empty(appendGetParam())) ? appendGetParam().'&r_id='.$val['id'] : '?p_id='.$val['id']; ?>" class="panel">
          <div class="panel-head">
            <img src="<?php echo showImg(sanitize($val['pic1'])); ?>" alt="<?php echo sanitize($val['recipe_name']); ?>">
          </div>
          <div class="panel-body">
            <p class="panel-title">
              <?php echo sanitize($val['recipe_name']); ?>
            </p>
          </div>
        </a>
        <?php
          endforeach;
        endif;
        ?>
        
      </section>
    </section>

    <!-- サイドバー -->
    <?php
    require('sidebar_mypage.php');
    ?>
  </div>

    <!-- footer -->
    <?php
    require('footer.php');
    ?>