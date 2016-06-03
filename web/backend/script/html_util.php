<?php
/**
 * [TQBlog] (C)2008-2028 tqtqtq.com
 * @author TQBlog Team
 * This is NOT a freeware, use is subject to license terms
 * $Id: html_util.php 33828 2008-02-22 09:25:26Z team $
 */
 
header('Content-Type: application/x-javascript; Charset=utf-8');

require '../function/function_base.php';

$tqb->CheckGzip();
$tqb->Load();
?>
var bloghost="<?php echo $bloghost; ?>";
var cookiespath="<?php echo $cookiespath; ?>";
var str01="<?php echo $lang['error']['72']; ?>";
var str02="<?php echo $lang['error']['29']; ?>";
var str03="<?php echo $lang['error']['46']; ?>";

<?php
echo '$(document).ready(function(){';

if ($tqb->CheckRights('admin')){
	echo "$('.cp-hello').html('" . $tqb->lang['msg']['welcome'] . ' ' . $tqb->user->Name .  " ("  . $tqb->user->LevelName  . ")');";
	echo "$('.cp-login').find('a').html('[" . $tqb->lang['msg']['admin'] . "]');";
}
if ($tqb->CheckRights('ArticleEdt')){
	echo "$('.cp-vrs').find('a').html('[" . $tqb->lang['msg']['new_article'] . "]');";
	echo "$('.cp-vrs').find('a').attr('href','" . $tqb->host . "admin/admin.php?act=ArticleEdt');";
}

	echo "SetCookie('timezone',(new Date().getTimezoneOffset()/60)*(-1));";
echo '});' . "\r\n";

foreach ($GLOBALS['Filter_Plugin_Html_Util'] as $fpname => &$fpsignal) {$fpname();}

die();

?>