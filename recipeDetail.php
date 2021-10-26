<?php
//共通変数・関数ファイルを読み込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug(' レシピ一詳細ページ ');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//================================
// 画面処理
//================================
// 商品IDのGETパラメータを取得
$r_id = (!empty($_GET['r_id'])) ? $_GET['r_id'] : '';
// DBから商品データを取得

// var_dump($r_id);
// exit();

$viewData = getRecipeOne($r_id);
// パラメータに不正な値が入っているかチェック
if(empty($viewData)){
  error_log('エラー発生:指定ページに不正な値が入りました');
  header("Location:index.php"); //トップページへ
}
debug('取得したDBデータ：'.print_r($viewData,true));
?>
<?php
$siteTitle = 'レシピ一詳細ページ';
require('head.php');
?>

    <style>
      .badge {
        padding: 5px 10px;
        color: white;
        background: aqua;
        margin-right: 10px;
        font-size: 16px;
        position: relative;
        top: -3px;
      }
      #main .title {
        font-size: 28px;
        padding: 10px 0;
      }
      .recipe-img-container {
        overflow: hidden;
      }
      .recipe-img-container img {
        width: 100%;
      }
      .recipe-img-container .img-main {
        width: 750px;
        float: left;
      }
      .recipe-img-container .img-sub {
        width: 230px;
        float: left;
        background: #f6f5f4;
        padding: 15px;
        box-sizing: border-box;
      }
      .recipe-img-container .img-sub img {
        margin-bottom: 15px;
      }
      .recipe-img-container .img-sub img:last-child {
        margin-bottom: 0;
      }
      .recipe-detail {
        background: #f6f5f4;
        padding: 15px;
        margin-top: 15px;
        min-height: 150px;
      }
      .item-left {
        padding: 15px;
      }
      /* お気に入りアイコン */
      .icn-like{
        float: right;
        color: #ddd;
      }
      .icn-like:hover{
        cursor: pointer;
      }
      .icn-like.active{
        float: right;
        color: #fe8a8b;
      }
      .item-left a {
        cursor: pointer;
        text-decoration: none;
      }
    </style>

  <body class="page-recipeDetail page-1colum">

    <!-- メニュー -->
    <?php
    require('header.php');
    ?>
    

    <!-- メインコンテンツ -->
    <div id="contents" class="site-width">

      <!-- Main -->
      <section id="main" >

       <div class="title">
         <span class="badge"><?php echo sanitize($viewData['category']); ?></span><?php echo sanitize($viewData['recipe_name']); ?>
         <i class="fa fa-heart icn-like js-click-like <?php if(isLike($_SESSION['user_id'], $viewData['id'])){ echo 'active'; } ?>" aria-hidden="true" data-recipe_id="<?php echo sanitize($viewData['id']); ?>"></i>
       </div>
       <div class="recipe-img-container">
         <div class="img-main">
          <img src="<?php echo showImg(sanitize($viewData['pic1'])); ?>" alt="メイン画像：<?php echo sanitize($viewData['recipe_name']); ?>" id="js-switch-img-main">
         </div>
         <div class="img-sub">
           <img src="<?php echo showImg(sanitize($viewData['pic1'])); ?>" alt="画像１：<?php echo sanitize($viewData['recipe_name']); ?>" class="js-switch-img-sub">
           <img src="<?php echo showImg(sanitize($viewData['pic2'])); ?>" alt="画像２：<?php echo sanitize($viewData['recipe_name']); ?>" class="js-switch-img-sub">
           <img src="<?php echo showImg(sanitize($viewData['pic3'])); ?>" alt="画像３：<?php echo sanitize($viewData['recipe_name']); ?>" class="js-switch-img-sub">
         </div>
       </div>
       <div class="recipe-detail">
         <p><?php echo sanitize($viewData['comment']); ?>
         </p>
       </div>
       <div class="item-left">
         <a href="index.php<?php echo appendGetParam(array('r_id')); ?>">&lt; 商品一覧へ戻る</a>
       </div>

      </section>

    </div>

    <!-- footer -->
    <?php
    require('footer.php');
    ?>
    