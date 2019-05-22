<?php
$lessionCount=0;
for($i=1; $i<11; $i++)
{
  if($_SESSION['user_L'.$i]==1)
  {
    $lessionCount+=10;
  }
}
//Recalculate each time when access the session data
$LR=0;
if($_SESSION['user_L1']) $LR+=5;
if($_SESSION['user_L2']) $LR+=5;
if($_SESSION['user_L5']) $LR+=5;
if($_SESSION['user_L8']) $LR+=5;
if($_SESSION['user_L9']) $LR+=5;

if($_SESSION['user_L3']) $LR+=20;
if($_SESSION['user_L4']) $LR+=20;
if($_SESSION['user_L6']) $LR+=20;
if($_SESSION['user_L7']) $LR+=20;
if($_SESSION['user_L10']) $LR+=20;

//Record the bages
$bages=0;
if($_SESSION['user_L1']==1)
{
  $bages++;
}
if($_SESSION['user_L2']==1 && $_SESSION['user_L3']==1 && $_SESSION['user_L4']==1)
{
  $bages++;
}
if($_SESSION['user_L5']==1 && $_SESSION['user_L6']==1 && $_SESSION['user_L7']==1&& $_SESSION['user_L8']==1)
{
  $bages++;
}
if($_SESSION['user_L9']==1 && $_SESSION['user_L10']==1)
{
  $bages++;
}

?>
