<?php
/*******************************************************************************

    Copyright 2007,2010 Whole Foods Co-op

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

$IS4C_PATH = isset($IS4C_PATH)?$IS4C_PATH:"";
if (empty($IS4C_PATH)){ while(!file_exists($IS4C_PATH."is4c.css")) $IS4C_PATH .= "../"; }

if (!class_exists('PhpAutoLoader')) {
    require(dirname(__FILE__) . '/../../vendor-code/PhpAutoLoader/PhpAutoLoader.php');
}

if (session_id() === '') {
    session_start();
}

/**
  Unreserve custdata account
  clear session
  redirect
*/
unset($_SESSION['userInfo']);
$uuid = $_SESSION['UUID'];
unset($_SESSION['UUID']);

$dbc = Database::pDataConnect();
$prep = $dbc->prepare_statement('
    UPDATE custdata
    SET FirstName=\'\'
    WHERE FirstName=?
');
$res = $dbc->exec_statement($prep, array($uuid));

header('Location: ../');

