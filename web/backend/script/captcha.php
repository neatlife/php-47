<?php
/**
 * [TQBlog] (C)2008-2028 tqtqtq.com
 * @author TQBlog Team
 * This is NOT a freeware, use is subject to license terms
 * $Id: captcha.php 33828 2008-02-22 09:25:26Z team $
 */

require '../function/function_base.php';
$tqb->Load();
ob_clean();

$tqb->ShowCaptcha(GetVars('id','GET'));