<?php
/* Smarty version 3.1.32, created on 2025-06-18 13:04:47
  from '/Users/hollie/Project/smarty/app/admin/view/privilege/login.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_685248ef92bb45_86588723',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95bbd8d3dab4b5277580e1e1352c2ee92dc71a29' => 
    array (
      0 => '/Users/hollie/Project/smarty/app/admin/view/privilege/login.html',
      1 => 1750223072,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_685248ef92bb45_86588723 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xm1ns="http://www.w3.org/1999/xhtm]">
    <head>
        <meta http-equiv="Content-Type" content="text/htm1; charset=utf-8" />
        <title>博客后台</title>
        <link rel="stylesheet" type="text/css" href="<?php echo P;?>
/css/app.css" />
        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo P;?>
/js/app.js"> <?php echo '</script'; ?>
>
    </head>
    <body>
        <div class="loginform">
            <div class="title"> 
                <span class="logo-text font18">部落格後台管理系统</span>
            </div>
            <div class="body">
                <form id="form1" name="form1" method="post" action="index.php?p=admin&c=privilege&a=check">
                    
                    <label class="log-lab">帳號</label>
                    <input name="u_username" type="text" class="login-input-user" id="textfield" value=""/>

                    <label class="log-lab">密碼</label>
                    <input name="u_password" type="password" class="login-input-pass" id="textfield" value=""/>
                    
                    <label class="log-lab">驗證碼</label>
                    <div class="padding-bottom5"><img src="index.php?p=admin&c=privilege&a=captcha&" width="220" height="30"
                        onclick="this.src='index.php?p=admin&c=privilege&a=captcha&'+Math.random();"></div>
                    <input name="captcha" type="text" class="login-input" id="textfield" value=""/>
                    
                    <label class="log-lab"><input type="checkbox" name="remenberfle"class="uniform">天内自动登录</label>
                    <input type="submit" name="button" id="button" value="登录" class="button"/>

                </form>
            </div>
            </div>
        </div>
    </body>
</htm]><?php }
}
