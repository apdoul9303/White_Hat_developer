<?php
//session_start() ，to access $_SESSION['link'] and use this link to connect the database
@session_start();
/**
 * Get all users(admin)
 */
function get_all_users()
{
  //Declaring an empty array
  $datas = array();

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "SELECT * FROM `realuser`";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //Use the mysqli_num_rows method to determine the syntax of the execution,
    //and whether the amount of data it gets is greater than 0.
    if (mysqli_num_rows($query) > 0)
    {
      //The amount obtained is greater than 0, which means that there is data.
      //The while loop will determine the number of runs based on the number of queries.
      //get the data by using "mysqli_fetch_assoc" method
      while ($row = mysqli_fetch_assoc($query))
      {
        $datas[] = $row;
      }
    }
    //Release the memory of the database query
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }
  //Return the result
  return $datas;
}
/**
 * Get all comments (admin)
 */
function get_all_comment_admin()
{
  //Declaring an empty array
  $datas = array();

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "SELECT * FROM `comments` ORDER BY `create_date` DESC;";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //Use the mysqli_num_rows method to determine the syntax of the execution,
    //and whether the amount of data it gets is greater than 0.
    if (mysqli_num_rows($query) > 0)
    {
      //The amount obtained is greater than 0, which means that there is data.
      //The while loop will determine the number of runs based on the number of queries.
      //get the data by using "mysqli_fetch_assoc" method
      while ($row = mysqli_fetch_assoc($query))
      {
        $datas[] = $row;
      }
    }

    //Release the memory of the database query
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $datas;
}

/**
 * Get all article (admin)
 */
function get_all_article_admin()
{
  //Declaring an empty array
  $datas = array();

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "SELECT * FROM `articles` ORDER BY `create_date` DESC;";
  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //Use the mysqli_num_rows method to determine the syntax of the execution,
    //and whether the amount of data it gets is greater than 0.
    if (mysqli_num_rows($query) > 0)
    {
      //The amount obtained is greater than 0, which means that there is data.
      //The while loop will determine the number of runs based on the number of queries.
      //get the data by using "mysqli_fetch_assoc" method
      while ($row = mysqli_fetch_assoc($query))
      {
        $datas[] = $row;
      }
    }

    //Release the memory of the database query
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $datas;
}

/**
 * Check the username has existed in the database or not.
 */
function check_has_username($email)
{
	//Declare the result of the return
  $result = null;

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "SELECT * FROM `realuser` WHERE `email` = '{$email}';";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //Use the mysqli_num_rows method to determine the syntax of the execution,
    //the amount of data it has, and whether there is a data
    if (mysqli_num_rows($query) >= 1)
    {
      //If the amount obtained is greater than 0, it means that there is data.
      //The returned $result is true to mean the account has existed and cannot be added.
      $result = true;
    }

    //Release the memory of the database query
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $result;
}

/**
 * Register a new user account
 */
function add_user($email, $password, $name)
{
	//Declare the result of the return
  $result = null;
	//$salt is the plaintext for auxiliary encryption password
  $salt = "TINGYU";
  //Add two plaintext strings to the password and encrypt it with md5
	$password = md5($salt.md5($password).$salt);
  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "INSERT INTO `realuser` (`email`, `password`, `name`, `img_path`) VALUE ('{$email}', '{$password}', '{$name}', 'images/giraffe.jpg');";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //Use mysqli_affected_rows to discriminate the data of the transaction,
    //there are a few strokes, basically only add a new one, so judge whether == 1
    if(mysqli_affected_rows($_SESSION['link']) == 1)
    {
      //If the amount obtained is greater than 0, it means that there is data.
      //The returned $result is true to mean the account has existed and cannot be added.
      $result = true;
    }
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }
  //Return the result
  return $result;
}

/**
 * verify_user
 */
function verify_user($username, $password)
{
  //Declare the result of the return
  $result = null;

  //$salt is the plaintext for auxiliary encryption password
  $salt = "TINGYU";
  //Add two plaintext strings to the password and encrypt it with md5
  $password = md5($salt.md5($password).$salt);

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "SELECT * FROM `realuser` WHERE `email` = '{$username}' AND `password` = '{$password}'";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //There are several results for returning a $query request using mysqli_num_rows.
    //If a member is found means the password is correct.
    if(mysqli_num_rows($query) == 1)
    {
      //access the user'date
      $user = mysqli_fetch_assoc($query);

      //Set is_login== true in the session, indicating that user have logged in.
      if($user['email']=='tinyu1016@gmail.com')
      {
        $_SESSION['is_admin'] = TRUE;
        $_SESSION['is_login'] = TRUE;
        $result = 'admin';
      }else
      {


      $_SESSION['is_login'] = TRUE;
      $_SESSION['is_admin'] = FALSE;
      //Record the data of the registrant.
      //To get the user status at any time by accessing $_SESSION.
      $_SESSION['login_user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['name'];
      $_SESSION['user_img_path'] = $user['img_path'];
      $_SESSION['user_img_css'] = $user['img_css'];

      $_SESSION['user_L1'] = $user['L1'];
      $_SESSION['user_L2'] = $user['L2'];
      $_SESSION['user_L3'] = $user['L3'];
      $_SESSION['user_L4'] = $user['L4'];
      $_SESSION['user_L5'] = $user['L5'];
      $_SESSION['user_L6'] = $user['L6'];
      $_SESSION['user_L7'] = $user['L7'];
      $_SESSION['user_L8'] = $user['L8'];
      $_SESSION['user_L9'] = $user['L9'];
      $_SESSION['user_L10'] = $user['L10'];
      //The returned $result ==true means the verification was successful.
      $result = true;
      }
    }
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $result;
}


/**
 * get all publish articles
 */
function get_publish_article()
{
  //Declaring an empty array
  $datas = array();

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "SELECT * FROM `articles` WHERE `publish` = 1;";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //Use the mysqli_num_rows method to determine the syntax of the execution,
    //and whether the amount of data it gets is greater than 0.
    if (mysqli_num_rows($query) > 0)
    {
      //The amount obtained is greater than 0, which means that there is data.
      //The while loop will determine the number of runs based on the number of queries.
      //get the data by using "mysqli_fetch_assoc" method
      while ($row = mysqli_fetch_assoc($query))
      {
        $datas[] = $row;
      }
    }

    //Release the memory of the database query
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $datas;
}

/**
 * get one article
 */
function get_article($id)

{
  //Declare the result of the return
  $result = null;

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "SELECT * FROM `articles` WHERE `id` = {$id};";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //Use the mysqli_num_rows method to determine the syntax of the execution,
    //the amount of data obtained, whether there is a data
    if (mysqli_num_rows($query) == 1)
    {
      //Save the obtained article data to $result
      $result = mysqli_fetch_assoc($query);
    }

    //Release the memory of the database query
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $result;
}

/**
 * Get publish articles by categories
 */
function get_publish_article_category($c)
{
  //Declaring an empty array
  $datas = array();

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "SELECT * FROM `articles` WHERE `publish` = 1 AND `category` = '{$c}';";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //Use the mysqli_num_rows method to determine the syntax of the execution,
    //and whether the amount of data it gets is greater than 0.
    if (mysqli_num_rows($query) > 0)
    {
      //The amount obtained is greater than 0, which means that there is data.
      //The while loop will determine the number of runs based on the number of queries.
      //get the data by using "mysqli_fetch_assoc" method
      while ($row = mysqli_fetch_assoc($query))
      {
        $datas[] = $row;
      }
    }

    //Release the memory of the database query
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $datas;
}


/**
 * Get one comment
 */
function get_one_comment($id)
{
  //Declare the result of the return
  $result = null;

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "SELECT * FROM `comments` WHERE `id` = {$id};";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //Use the mysqli_num_rows method to determine the syntax of the execution,
    //the amount of data obtained, whether there is a data
    if (mysqli_num_rows($query) == 1)
    {
      //Save the obtained article data to $result
      $result = mysqli_fetch_assoc($query);
    }

    //Release the memory of the database query
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $result;
}

/**
 * Get article information
 */
function get_author($create_user_id)
{
  //Declare the result of the return
  $result = null;

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "SELECT * FROM `realuser` WHERE `id` = {$create_user_id};";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //Use the mysqli_num_rows method to determine the syntax of the execution,
    //the amount of data obtained, whether there is a data
    if (mysqli_num_rows($query) == 1)
    {
      //Save the obtained article data to $result
      $result = mysqli_fetch_assoc($query);
    }

    //Release the memory of the database query
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $result;
}


/**
 * Get all comments of this article
 */
function get_comment($article_id)
{
  //Declaring an empty array
  $datas = array();

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "SELECT * FROM `comments` WHERE `comment_article_id` = $article_id;";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    ///Use the mysqli_num_rows method to determine the syntax of the execution,
    //and whether the amount of data it gets is greater than 0.
    if (mysqli_num_rows($query) > 0)
    {
      //The amount obtained is greater than 0, which means that there is data.
      //The while loop will determine the number of runs based on the number of queries.
      //get the data by using "mysqli_fetch_assoc" method
      while ($row = mysqli_fetch_assoc($query))
      {
        $datas[] = $row;
      }
    }

    //Release the memory of the database query
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $datas;
}

/**
 * add new article
 */
function add_article($title, $category, $content, $publish)
{
	//Declare the result of the return
  $result = null;
  //Create date
  $create_date = date("Y-m-d H:i:s");
	//filter html input by using  htmlspecialchars()
	$content = htmlspecialchars($content);
	//get the user id  and name
	$creater_id = $_SESSION['login_user_id'];

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "INSERT INTO `articles` (`title`, `category`, `content`, `publish`, `create_date`, `create_user_id`)
  				VALUE ('{$title}', '{$category}', '{$content}', {$publish}, '{$create_date}', '{$creater_id}');";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //There are several ways to discriminate the transaction data by using mysqli_affected_rows(),
    //basically only a new one, so whether to judge == 1
    if(mysqli_affected_rows($_SESSION['link']) == 1)
    {
      $result = true;
    }
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $result;
}


/**
 * Get all article (user)
 */
function get_all_article()
{
  //Declaring an empty array
  $datas = array();
  $creater_id = $_SESSION['login_user_id'];

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "SELECT * FROM `articles` WHERE `create_user_id` = $creater_id ORDER BY `create_date` DESC;";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //Use the mysqli_num_rows method to determine the syntax of the execution,
    //and whether the amount of data it gets is greater than 0.
    if (mysqli_num_rows($query) > 0)
    {
      //The amount obtained is greater than 0, which means that there is data.
      //The while loop will determine the number of runs based on the number of queries.
      //get the data by using "mysqli_fetch_assoc" method
      while ($row = mysqli_fetch_assoc($query))
      {
        $datas[] = $row;
      }
    }

    //Release the memory of the database query
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $datas;
}

/**
 * Update article
 */
function update_article($id, $title, $category, $content, $publish)
{
	//Declare the result of the return
  $result = null;
  //Create date
  $modify_date = date("Y-m-d H:i:s");
	//filter html input by using  htmlspecialchars()
	$content = htmlspecialchars($content);

	//Treat the query syntax as a string, stored in the $sql variable
  $sql = "UPDATE `articles` SET `title` = '{$title}', `category` = '{$category}',
   `content` = '{$content}', `publish` = {$publish}, `modify_date` = '{$modify_date}'
  				WHERE `id` = {$id};";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //There are several ways to discriminate the transaction data by using mysqli_affected_rows(),
    //basically only a new one, so whether to judge == 1
    if(mysqli_affected_rows($_SESSION['link']) == 1)
    {
      $result = true;
    }
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $result;
}

/**
 * Update the comment
 */
function update_comment($id, $content)
{
	//Declare the result of the return
  $result = null;
  //Create date
  $modify_date = date("Y-m-d H:i:s");
	//filter html input by using  htmlspecialchars()
	$content = htmlspecialchars($content);

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "UPDATE `comments` SET `content` = '{$content}', `create_date` = '{$modify_date}'
  				WHERE `id` = {$id};";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //There are several ways to discriminate the transaction data by using mysqli_affected_rows(),
    //basically only a new one, so whether to judge == 1
    if(mysqli_affected_rows($_SESSION['link']) == 1)
    {

      $result = true;
    }
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }
  //return the result
  return $result;
}

/**
 * Delete Article(also delete the comments which belone this article)
 */
function del_article($id)
{
	//Declare the result of the return
  $result = null;
  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "DELETE FROM `articles` WHERE `id` = {$id};";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //There are several ways to discriminate the transaction data by using mysqli_affected_rows(),
    //basically only a new one, so whether to judge == 1
    if(mysqli_affected_rows($_SESSION['link']) == 1)
    {
      $result = true;
      del_comment_by_article($id);
    }
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $result;
}
/**
 * delete the user account
 */
function del_user($id)
{
	//Declare the result of the return
  $result = null;
  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "DELETE FROM `realuser` WHERE `id` = {$id};";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //There are several ways to discriminate the transaction data by using mysqli_affected_rows(),
    //basically only a new one, so whether to judge == 1
    if(mysqli_affected_rows($_SESSION['link']) == 1)
    {
      $result = true;
      del_article_by_user($id);
      del_comment_by_user($id);
    }
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $result;
}
/**
 * Delete comment by user
 */
function del_article_by_user($id)
{
	//Declare the result of the return
  $result = null;

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "DELETE FROM `articles` WHERE `create_user_id` = {$id};";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //There are several ways to discriminate the transaction data by using mysqli_affected_rows(),
    //basically only a new one, so whether to judge == 1
    if(mysqli_affected_rows($_SESSION['link']) == 1)
    {
      $result = true;
      del_comment_by_article($id);
    }
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $result;
}
/**
 * Delete comment by user
 */
function del_comment_by_user($id)
{
	//Declare the result of the return
  $result = null;

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "DELETE FROM `comments` WHERE `create_user_id` = {$id};";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //There are several ways to discriminate the transaction data by using mysqli_affected_rows(),
    //basically only a new one, so whether to judge == 1
    if(mysqli_affected_rows($_SESSION['link']) == 1)
    {
      $result = true;
    }
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $result;
}
/**
 * Delete comment by article
 */
function del_comment_by_article($id)
{
	//Declare the result of the return
  $result = null;

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "DELETE FROM `comments` WHERE `comment_article_id` = {$id};";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //There are several ways to discriminate the transaction data by using mysqli_affected_rows(),
    //basically only a new one, so whether to judge == 1
    if(mysqli_affected_rows($_SESSION['link']) == 1)
    {
      $result = true;
    }
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $result;
}


/**
 * Delete comment
 */
function del_comment($id)
{
	//Declare the result of the return
  $result = null;

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "DELETE FROM `comments` WHERE `id` = {$id};";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //There are several ways to discriminate the transaction data by using mysqli_affected_rows(),
    //basically only a new one, so whether to judge == 1
    if(mysqli_affected_rows($_SESSION['link']) == 1)
    {
      $result = true;
    }
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $result;
}



/**
 * Update user photo
 */
function update_user_photo($img_path,$img_css)
{
  //Declare the result of the return
  $result = null;

	//Treat the query syntax as a string, stored in the $sql variable
  $sql = "UPDATE `realuser` SET `img_path` = '{$img_path}', `img_css`= '{$img_css}'
  				WHERE `id` = {$_SESSION['login_user_id']};";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //There are several ways to discriminate the transaction data by using mysqli_affected_rows(),
    //basically only a new one, so whether to judge == 1
    if(mysqli_affected_rows($_SESSION['link']) == 1)
    {
      $result = true;
    }
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $result;
}



/**
 * Add new comment
 */
function add_comment($content)
{
	//Declare the result of the return
  $result = null;
  //Create date
  $create_date = date("Y-m-d H:i:s");
	//filter html input by using  htmlspecialchars()
	$content = htmlspecialchars($content);
	//Get user id and article id
	$creater_id = $_SESSION['login_user_id'];
  $article_id =$_SESSION['article_id'];

	//Treat the query syntax as a string, stored in the $sql variable
  $sql = "INSERT INTO `comments` (`comment_article_id`, `content`, `create_date`, `create_user_id`)
  				VALUE ('{$article_id}','{$content}', '{$create_date}', '{$creater_id}');";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //There are several ways to discriminate the transaction data by using mysqli_affected_rows(),
    //basically only a new one, so whether to judge == 1
    if(mysqli_affected_rows($_SESSION['link']) == 1)
    {
      $result = true;
    }
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $result;
}



/**
 * Get my articles
 */
function get_my_article($id)
{
  //Declaring an empty array
  $datas = array();

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "SELECT * FROM `articles` WHERE `create_user_id` = {$id};";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //Use the mysqli_num_rows method to determine the syntax of the execution,
    //and whether the amount of data it gets is greater than 0.
    if (mysqli_num_rows($query) > 0)
    {
      //The amount obtained is greater than 0, which means that there is data.
      //The while loop will determine the number of runs based on the number of queries.
      //get the data by using "mysqli_fetch_assoc" method
      while ($row = mysqli_fetch_assoc($query))
      {
        $datas[] = $row;
      }
    }

    //Release the memory of the database query
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $datas;
}
/**
 * Get my comments
 */
function get_my_comment($id)
{
  //Declaring an empty array
  $datas = array();

  //Treat the query syntax as a string, stored in the $sql variable
  $sql = "SELECT * FROM `comments` WHERE `create_user_id` = {$id};";

  //Use the mysqli_query method to take the execution request (that is, the sql syntax),
  //and the result of the request will be stored in the $query variable.
  $query = mysqli_query($_SESSION['link'], $sql);

  //If the request is successful
  if ($query)
  {
    //Use the mysqli_num_rows method to determine the syntax of the execution,
    //and whether the amount of data it gets is greater than 0.
    if (mysqli_num_rows($query) > 0)
    {
      //The amount obtained is greater than 0, which means that there is data.
      //The while loop will determine the number of runs based on the number of queries.
      //get the data by using "mysqli_fetch_assoc" method
      while ($row = mysqli_fetch_assoc($query))
      {
        $datas[] = $row;
      }
    }

    //Release the memory of the database query
    mysqli_free_result($query);
  }
  else
  {
    echo "{$sql} execution failed, error message：" . mysqli_error($_SESSION['link']);
  }

  //Return the result
  return $datas;
}


?>
