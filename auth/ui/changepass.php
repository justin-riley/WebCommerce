<?php
/*******************************************************************************

    Copyright 2009 Whole Foods Co-op

    This file is part of IS4C.

    IS4C is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    IS4C is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    in the file license.txt along with IS4C; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*********************************************************************************/
return;

require('../login.php');
$path = guesspath();
$page_title = 'IS4C : Auth : Change Password';
$header = 'IS4C : Auth : Change Password';

$name = checkLogin();
if (!$name){
  echo "<html><body bgcolor=cabb1e>";
  echo "Somehow you ended up logged out.  <a href=loginform.php>Login</a>?";
}
else {
  if (isset($_POST['name'])){
    $name = $_POST['name'];
    $oldpass = $_POST['oldpass'];
    $newpass1 = $_POST['newpass1'];
    $newpass2 = $_POST['newpass2'];
    if ($newpass1 != $newpass2){
      echo "<html><body bgcolor=cabb1e>";
      echo "Passwords don't match<p />";
      echo "<a href=changepass.php>Try again</a> | <a href=menu.php>Main menu</a>";
    }
    else {
      $success = changePassword($name,$oldpass,$newpass1);
      echo "<html><body bgcolor=cabb1e>";
      if (!$success){
	echo "Password change failed.  Ensure the old password is correct and that the new password is alphanumeric<p />";
	echo "<a href=changepass.php>Try again</a> | <a href=menu.php>Main menu</a>";
      }
      else {
	echo "Password changed successfully<p />";
	echo "<a href=menu.php>Continue</a>";
      }
    }
  }
  else {
    echo "<html><body bgcolor=cabb1e>";
    echo "<form action=changepass.php method=post>";
    echo "<table cellspacing=2 cellpadding=2";
    echo "<tr><td>Username:</td><td>$name <input type=hidden name=name value=$name></td></tr>";
    echo "<tr><td>Old password:</td><td><input type=password name=oldpass></td></tr>";
    echo "<tr><td>New password:</td><td><input type=password name=newpass1></td></tr>";
    echo "<tr><td>New password, again:</td><td><input type=password name=newpass2></td></tr>";
    echo "<tr><td><input type=submit value=Change></td><td><input type=reset value=Clear></td></tr>";
    echo "</table></form>";
  }
}

?>

</body>
</html>
