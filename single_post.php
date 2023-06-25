<?php
// error_reporting(E_ERROR | E_PARSE);
session_start();
$page_title = 'Get_Jobs';
include('connection.php');
include('include/Top_bar.php');   
if(isset($_SESSION['username'])){
    include("include/header2.php"); 
}else{
    include("include/login_header.php");
}
$page = basename($_SERVER['PHP_SELF'],'.php');

//fetch blog id
if(isset($_GET['pid'])){
 $p_id =  $_GET['pid'];
 $s_id =  $_GET['sid'];
}
//fetch blogs
$blogs = '';
$html = "";
$cat = '';
$categories = '';
$serial = 0;
if($p_id != '' && $s_id!= ''){
$query = "SELECT * FROM  job_posts where p_id = '".$p_id."'";
$run   = mysqli_query($conn,$query);
while($value = mysqli_fetch_array($run)){
    $pid = $value['p_id'];
    $title = $value['title'];
    $disc  = $value['job_discription']; 
    $catid   = $value['category'];
    $username= $value['username'];
    $publish_date  = $value['publish_date'];
    $p_date = date('d/m/Y', strtotime($publish_date));
     //fetch category from cat table
      $query1 = "SELECT * FROM  categories WHERE cat_id = '".$catid."'";
      $run1   = mysqli_query($conn,$query1);
      $value1 = mysqli_fetch_array($run1);
      $cat_name   =  $value1['category'];
      $html    .='<div class="col-lg-8 col-sm-12">
                        <h2 class="most_text" style="color: green; font-weight: 700;">'.$title.''.".".'</h2> 
                        <p class="">Published date : '.$p_date.'</p>
                        <p class=" text-capitalize">'.$disc.'</p>
                     </div>';
}
}else{
   $html =  '
               <div class="col-md-12 mx-auto">
                  <div class="alert alert-info position-absolute">
                     Post Not Found.
                  </div>
               </div>
            </div>';
}
//fetch all blogs same categories
$query1 = "SELECT * FROM  job_posts where category = '".$s_id."'";
$run1    = mysqli_query($conn,$query1);
while($value1  = mysqli_fetch_array($run1)){;
$p_id    = $value1['p_id'];
$title = $value1['title'];
$disc  = $value1['job_discription'];
// $b_img   = $value1['blog_img'];
$catid     = $value1['category'];

//strip text
$disc = strip_tags($disc);
  if (strlen($disc) > 50) {
      $blogCut = substr($disc, 0, 50);
      $endPoint = strrpos($blogCut, " ");
      $disc = $endPoint? substr($blogCut, 0, $endPoint) : substr($blogCut, 0);  
  }
$blogs .='<div class="col-lg-12">
            <a href="single_blog.php?bid='.$p_id.'&cid='.$catid.'"> 
               <h6>'.$title.'</h6>
               <p class="disc_text"style="text-align: justify !important;">'.$disc.''."..".'</p> 
            </div>
            </a>
        </div>'; 
}
?>

<div class=" p-4">
      <div class="container border p-5 " style="border-radius: 20px;"> 
            <div class="row">
               <div class="col-1 ms-auto">
                  <a href="Job_bank.php" class="btn btn-outline-dark ">Back</a>
               </div>
            </div>
            <div class="row ">
              <div class="col-lg-11 ">
              <?php echo $html; ?> 
              <br>
              <strong class="p-2  text-success">
                  <span>Company Name : </span>
                  <span><?php echo $username ;?></span>
              </strong>
              </div>
            </div>
            <div class="row">
               <div class="col-12 mb-2 mt-3"> 
                  <strong>Categories :</strong>
               </div> 
               <div class="col-12">
                  <span class="btn rounded-0 btn-outline-success"><?php echo $cat_name ;?></span>
               </div> 
            </div>
            <div class="row">
               <div class="col-3 ms-auto">
                  <a href="apply.php" class="btn btn-outline-success">Apply Now</a>
               </div>
            </div>
         </div>
      </div>
      <!-- blog section end --> 

<!-- footer section -->
<?php include('include/footer.php'); ?>
    