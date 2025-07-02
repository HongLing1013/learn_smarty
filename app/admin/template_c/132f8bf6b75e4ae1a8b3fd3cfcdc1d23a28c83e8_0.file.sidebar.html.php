<?php
/* Smarty version 3.1.32, created on 2025-06-30 13:06:53
  from '/Users/hollie/Project/smarty/app/admin/view/Public/sidebar.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_68621b6d6e34f4_21080666',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '132f8bf6b75e4ae1a8b3fd3cfcdc1d23a28c83e8' => 
    array (
      0 => '/Users/hollie/Project/smarty/app/admin/view/Public/sidebar.html',
      1 => 1750224394,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68621b6d6e34f4_21080666 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="sidebar">
    <div id="searchbox" style="z-index: 880;">  
        <div class="in" style="z-index: 870;">
            <p class="text-center font18 line-height35">此广告位常年招商</p>
        </div>
    </div>
    <!-- START SIDEMENU -->
    <div id="sidemenu">
        <ul>
            <li class="active"><a href="index.html"><img src="<?php echo P;?>
/img/icons/sidemenu/laptop.png" width="16"
                height="16" alt="icon"/>控制面板</a></li>
            <?php if ($_SESSION['user']['is_admin']) {?>
            <!-- 分类管理 -->
            <li class="subtitle">
                <a class="action tips-right" href="#" title="分类管理">
                    <img src="<?php echo P;?>
/img/icons/sidemenu/key.png" width="16" height="16" alt="icon"/>分类管理
                    <img src="<?php echo P;?>
/img/arrow-down.png" width="7" height="4" alt="arrow" class="arrow" />
                </a>
                <ul class="submenu display-block">
                    <li>
                        <a href="index.php?p=admin&c=category">
                            <img src="<?php echo P;?>
/img/icons/sidemenu/file.png" width="16"
                                 height="16" alt="icon"/>分类列表
                        </a>
                    </li>
                    <li>
                        <a href="categoryAdd.html">
                            <img src="<?php echo P;?>
/img/icons/sidemenu/file_add.png" width="16"
                                 height="16" alt="icon"/>添加分类
                        </a>
                    </li>
                </ul>
            </li>
            <!-- 分类管理 - -->
             <?php }?>

            <!-- 博文管理 -->
            <li class="subtitle">
                <a class="action tips-right" href="#" title="博文管理">
                    <img src="<?php echo P;?>
/img/icons/sidemenu/mail.png" width="16" height="16" alt="icon"/>博文管理
                    <img src="<?php echo P;?>
/img/arrow-down.png" width="7" height="4" alt="arrow" class="arrow" /></a>
                <ul class="submenu display-block">
                    <li>
                        <a href="articleAdd.html">
                            <img src="<?php echo P;?>
/img/icons/sidemenu/file_add.png" width="16" height="16" alt="icon"/>添加博文
                        </a>
                    </li>
                    <li>
                        <a href="articleIndex.html">
                            <img src="<?php echo P;?>
/img/icons/sidemenu/file.png" width="16" height="16" alt="icon"/>博文列表
                        </a>
                    </li>
                </ul>
            </li>
            <!-- 博文管理 - -->

            <?php if ($_SESSION['user']['is_admin']) {?>
            <!-- 用戶管理 -->
            <li class="subtitle">
                <a class="action tips-right" href="#" title="用戶管理"><img src="<?php echo P;?>
/img/icons/sidemenu/user.png" width="16" height="16" alt="icon"/>用戶管理<img src="<?php echo P;?>
/img/arrow-down.png" width="7"
                   height="4" alt="arrow" class="arrow" /></a>
                <ul class="submenu display-block">
                    <li>
                        <a href="userAdd.html">
                            <img src="<?php echo P;?>
/img/icons/sidemenu/user_add.png" width="16"
                                 height="16" alt="icon"/>添加用戶
                        </a>
                    </li>
                    <li>
                        <a href="userIndex.html">
                            <img src="<?php echo P;?>
/img/icons/sidemenu/file.png" width="16" 
                                 height="16" alt="icon"/>用戶列表
                        </a>
                    </li>
                </ul>
            </li>
            <!-- 用戶管理 - -->

            <!-- 評論管理 -->
            <li>
                <a href="commentIndex.html">
                    <img src="<?php echo P;?>
/img/icons/sidemenu/file.png" width="16" height="16"
                         alt="icon"/>評論管理
                </a>
            </li>
            <!-- 評論管理 - -->
             <?php }?>
        </ul>
    </div>
    <!-- END SIDEMENU -->
</div><?php }
}
