<?php
/* Smarty version 3.1.32, created on 2025-06-09 13:13:41
  from '/Users/hollie/Project/smarty/app/admin/view/Public/header.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_68466d85ac4af8_25876740',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7fccab54ad8316b2c9358c330a12cc91bfb504b4' => 
    array (
      0 => '/Users/hollie/Project/smarty/app/admin/view/Public/header.html',
      1 => 1749446019,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68466d85ac4af8_25876740 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="header">
    <div class="logo">
        <a href="?">
            <span class="logo-text text-center font18">博客台</span>
        </a>
    </div>

    <!-- NOTIFICATIONS -->
    <div id="notifications">
        <div class="clear"></div>
    </div>

    <!-- QUICK MENU -->
    <div id="quickmenu">
        <a href="#" class="qbutton-left tips" title="新增一篇博客">
            <img src="<?php echo P;?>
/img/icons/header/newpost.png" width="18" height="14" alt="new post" />
        </a>
        <a href="#" class="dbutton-right tips" title="直达前台">
            <img src="<?php echo P;?>
/img/icons/sidemenu/magnify.png" width="18" height="14" alt="new post" />
        </a>
        <div class="clear"></div>
    </div>

    <!-- PROFILE BOX -->
    <div id="profilebox">
        <a href="#" class="display">
            <img src="img/simple-profile-img.jpg" width="33" height="33" alt="profile"/> 
            <span><?php if ($_SESSION['user']['is_admin']) {?>管理員<?php } else { ?>用戶<?php }?></span> 
            <b>暱稱 : <?php echo $_SESSION['user']['username'];?>
</b>
        </a>

        <div class="profilemenu">
            <ul>
                <li><a href="<?php echo URL;?>
/index.php?p=admin&c=privilege&a=logout">退出</a></li>
            </ul>
        </div>
    </div>
    <div class="clear"></div>
</div><?php }
}
