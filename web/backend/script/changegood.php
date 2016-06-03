<?php
/**
 * [TQBlog] (C)2008-2028 tqtqtq.com
 * @author TQBlog Team
 * This is NOT a freeware, use is subject to license terms
 * $Id: changegood.php 33828 2008-02-22 09:25:26Z team $
 */

require '../function/function_base.php';
$tqb->Load();
ob_clean();

$id=GetVars('id','POST');

if(isset($_COOKIE['articlegood'."_".$id]))
    echo "error||(已赞过)";
else{
    $fieldName='log_Good';
    $query="update %pre%post set $fieldName=$fieldName+1 where log_ID='$id'";
	$res=$tqb->db->Update($query);
    
    $query="select $fieldName from %pre%post where log_ID='$id'";
	$result=$tqb->db->Query($query);
	
    $count=$result[0][$fieldName];
    
	$expire=time()+$tqb->option['CFG_COOKIE_GOOD'];
    setcookie("articlegood"."_".$id, "articlegood"."_".$id, $expire);
		
    echo "success||".$count;
}
?>