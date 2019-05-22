<?php
$lessionCount=0;
for($i=1; $i<11; $i++)
{
  if($_SESSION['user_L'.$i]==1)
  {
    $lessionCount+=10;
  }
}
?>
<ul id="slide-out" class="sidenav">
  <li>
   <div class="chip">
    <img alt="photo" src="<?php echo ($_SESSION['user_img_path'] != NULL)?'../'.$_SESSION['user_img_path']:'../images/girl.jpeg';?>"  class="<?php echo $_SESSION['user_img_css'];?>"/>
    <?php echo $_SESSION['user_name']?>
   </div>
   <div class="chip">
    Lessons Completed &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lessionCount?>%
   </div>
 </li>
  <li><a class="waves-effect <?php echo ($_SESSION['user_L1'] == 1)?'list-group-item-success':'';?>" href="learn01.php" >Lesson 1: Overall Introduction</a></li>
  <li><div class="divider"></div></li>
  <li><a class="waves-effect <?php echo ($_SESSION['user_L2'] == 1)?'list-group-item-success':'';?>" href="learn02.php">Lesson 2: Introduction of SQL Injection</a></li>
  <li><a class="waves-effect <?php echo ($_SESSION['user_L3'] == 1)?'list-group-item-success':'';?>" href="learn03.php" >Lesson 3: In-Band Injection</a></li>
  <li><a class="waves-effect <?php echo ($_SESSION['user_L4'] == 1)?'list-group-item-success':'';?>" href="learn04.php" >Lesson 4: Union-Based Injection</a></li>
  <li><div class="divider"></div></li>
  <li><a class="waves-effect <?php echo ($_SESSION['user_L5'] == 1)?'list-group-item-success':'';?>" href="learn05.php" >Lesson 5: Introduction of Cross-site scripting</a></li>
  <li><a class="waves-effect <?php echo ($_SESSION['user_L6'] == 1)?'list-group-item-success':'';?>" href="learn06.php" >Lesson 6: Reflected XSS</a></li>
  <li><a class="waves-effect <?php echo ($_SESSION['user_L7'] == 1)?'list-group-item-success':'';?>" href="learn07.php" >Lesson 7: DOM-Based XSS</a></li>
  <li><a class="waves-effect <?php echo ($_SESSION['user_L8'] == 1)?'list-group-item-success':'';?>" href="learn08.php" >Lesson 8: Malicious phishing website</a></li>
  <li><div class="divider"></div></li>
  <li><a class="waves-effect <?php echo ($_SESSION['user_L9'] == 1)?'list-group-item-success':'';?>" href="learn09.php" >Lesson 9: Introduction of Broken Authentication</a></li>
  <li><a class="waves-effect <?php echo ($_SESSION['user_L10'] == 1)?'list-group-item-success':'';?>" href="learn10.php" >Lesson 10: Session Control(Login System)</a></li>
</ul>
<style>
#slide-out{
width:30%;
}
</style>
<script>
  $('.sidenav').sidenav();
</script>
