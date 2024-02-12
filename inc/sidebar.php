<?php 

  include_once 'classes/User.php';
  $user = new User();
  include_once 'classes/SiteOption.php';
  $site = new SiteOption();
  include_once 'classes/Post.php';
  $pt = new Post();
  include_once 'classes/Category.php';
  $ct = new Category();
  include_once 'helpers/Format.php';
  $fr = new Format();

?>

<div class="col-md-12 col-lg-4 sidebar">
  <div class="sidebar-box search-form-wrap">
    <form action="#" class="search-form">
      <div class="form-group">
        <span class="icon fa fa-search"></span>
        <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
      </div>
    </form>
  </div>
  <!-- END sidebar-box -->
  <div class="sidebar-box">

  <?php
  
    $userInfo = $user->userBio();
    if($userInfo){
      
      while($uinfo = mysqli_fetch_assoc($userInfo)){
      ?>
      <div class="bio text-center mt-5">
        <img src="admin/<?=$uinfo['image']?>" alt="Image Placeholder" class="img-fluid">
        <div class="bio-body">
          <h2><?=$uinfo['username']?></h2>
          <p><?=$uinfo['user_bio']?></p>
          <p><a href="#" class="btn btn-primary btn-sm rounded">Read my bio</a></p>
          <?php
            $allLinks = $site->allSocial();
              if($allLink){
                $links = mysqli_fetch_assoc($allLinks)
                  ?>
                  <p class="social">
                    <a target = "_blank" href="<?=$links['facebook']?>" class="p-2"><span class="fa fa-facebook"></span></a>
                    <a target = "_blank" href="<?=$links['twtter']?>" class="p-2"><span class="fa fa-twitter"></span></a>
                    <a target = "_blank" href="<?=$links['insta']?>" class="p-2"><span class="fa fa-instagram"></span></a>
                    <a target = "_blank" href="<?=$links['youtube']?>" class="p-2"><span class="fa fa-youtube-play"></span></a>
                  </p>
                  <?php
                
              }
          ?>
          
        </div>
      </div>
      <?php
    }
  }
  ?>
  </div>
  <!-- END sidebar-box -->
  <div class="sidebar-box">
    <h3 class="heading">Popular Posts</h3>
    <div class="post-entry-sidebar">
      <ul>
        <?php
        
        $allPost = $pt->showPopulerPost();
        if($allPost){
          while($prow = mysqli_fetch_assoc($allPost)){
            ?>
            <li>
            <a href="">
              <img src="admin/<?=$prow['imageOne']?>" alt="Image placeholder" class="mr-4">
              <div class="text">
                <h4><?=$prow['title']?></h4>
                <div class="post-meta">
                  <span class="mr-2"><?=$fr->fromatdate($prow['create_time'])?></span>
                </div>
              </div>
            </a>
          </li>
          <?php
          }
        
        }
        ?>

      </ul>
    </div>
  </div>
  <!-- END sidebar-box -->

  <div class="sidebar-box">
    <h3 class="heading">Categories</h3>
    <ul class="categories">
      <?php
        $allCat = $ct->AllCategory();
        if($allCat){
          while($catRow = mysqli_fetch_assoc($allCat)){
            ?>
                <li><a href="#"><?=$catRow['catName']?>
                <span>
                  (<?php
                    $catNum = $pt->catNum($catRow['catId']);
                    if($catNum){
                      echo $num = mysqli_num_rows($catNum);
                    }else{
                      echo "0";
                    }
                  ?>)
                </span></a></li>
            <?php
          }
        }
      ?>
    </ul>
  </div>
  <!-- END sidebar-box -->

  <div class="sidebar-box">
    <h3 class="heading">Tags</h3>
    <ul class="tags">
      <?php
        $allTag = $pt->showPopulerPost();
        if($allTag){
          while($row = mysqli_fetch_assoc($allTag)){
            ?>
              <li><a href="#"><?=$row['tags']?></a></li>
            <?php
          }
        }
      ?>
    </ul>
  </div>
</div>