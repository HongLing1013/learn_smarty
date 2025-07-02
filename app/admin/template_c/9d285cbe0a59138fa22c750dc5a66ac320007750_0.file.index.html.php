<?php
/* Smarty version 3.1.32, created on 2025-06-09 12:43:58
  from '/Users/hollie/Project/smarty/app/admin/view/Index/index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6846668e32b925_31146260',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d285cbe0a59138fa22c750dc5a66ac320007750' => 
    array (
      0 => '/Users/hollie/Project/smarty/app/admin/view/Index/index.html',
      1 => 1748928691,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/header.html' => 1,
    'file:../Public/sidebar.html' => 1,
    'file:../Public/footert.html' => 1,
  ),
),false)) {
function content_6846668e32b925_31146260 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>博客后台</title>
        <link rel="stylesheet" type="text/css" href="<?php echo P;?>
/css/app.css" />
    </head>
    <body>
        <!-- START WRAPPER -->
        <div class="wrapper">

            <!-- START HEADER -->
            <?php $_smarty_tpl->_subTemplateRender("file:../Public/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            <!-- END HEADER -->

            <!--  START MAIN -->
            <div id="main">
                <!-- START SIDEBAR -->
                <?php $_smarty_tpl->_subTemplateRender("file:../Public/sidebar.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                <!-- END SIDEBAR -->

                <!-- START PAGE -->
                <div id="page">
                    <!-- START PAGE TITLE -->
                    <div id="page-title">
                        <div class="in">
                            <div class="titlebar">
                                <h2>控制面板</h2>
                                <p>小標題</p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <!-- END PAGE TITLE -->
                    <!-- START CONTENT -->
                    <div class="content">
                        <!-- START simple tips -->
                        <div class="simple-tips">
                            <h2>提示</h2>
                            <ul>
                                <li>1. 使用左側的導航菜單進入功能</li>
                                <li>2. 使用右上角的退出按鈕退出管理後台</li>
                            </ul>
                            <a href="#" class="close tips" title="關閉">關閉</a>
                        </div>
                        <div class="simple-tips">
                            <h2>提示</h2>
                            <ul>
                                <li>1. 您當前使用的ip: <?php echo $_SERVER['REMOTE_ADDR'];?>
</li>
                                <li>2. PHP版本: <?php echo PHP_VERSION;?>
</li>
                                <li>3. 瀏覽器: <?php echo $_SERVER['HTTP_USER_AGENT'];?>
</li>
                            </ul>
                            <a href="#" class="close tips" title="關閉">關閉</a>
                        </div>

                        <!-- start DASHBUTTON -->
                        <div class="grid740">
                            <span class="dashbutton"> 
                                <img src="<?php echo P;?>
/img/icons/dashbutton/users.png" width="44" height="32" alt="icon" />
                                <b>用戶數</b> <?php echo $_smarty_tpl->tpl_vars['counts']->value;?>

                            </span>   
                            <div class="clear"></div>
                        </div>
                        <!-- end DASHBUTTON -->
                    </div>
                    <!-- end CONTENT -->
                </div>
                <!-- END PAGE -->
                <div class="clear"></div>
            </div>
            <!-- END MAIN -->

            <!-- START FOOTER -->
            <?php $_smarty_tpl->_subTemplateRender("file:../Public/footert.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            <!-- END FOOTER -->
        </div>
        <!-- END WRAPPER -->
        <?php echo '<script'; ?>
 type="text/javascript">
        // 側邊欄菜單切換功能
        document.addEventListener('DOMContentLoaded', function() {
            // 獲取所有帶有 subtitle 類的菜單項
            const subtitleLinks = document.querySelectorAll('.subtitle > a');
            
            subtitleLinks.forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault(); // 防止鏈接跳轉
                    
                    // 獲取對應的子菜單
                    const submenu = this.nextElementSibling;
                    
                    if (submenu && submenu.classList.contains('submenu')) {
                        // 切換顯示/隱藏狀態
                        if (submenu.classList.contains('display-block')) {
                            submenu.classList.remove('display-block');
                            submenu.style.display = 'none';
                        } else {
                            submenu.classList.add('display-block');
                            submenu.style.display = 'block';
                        }
                        
                        // 旋轉箭頭
                        const arrow = this.querySelector('.arrow');
                        if (arrow) {
                            if (submenu.classList.contains('display-block')) {
                                arrow.style.transform = 'rotate(180deg)';
                            } else {
                                arrow.style.transform = 'rotate(0deg)';
                            }
                        }
                    }
                });
            });
        });
        <?php echo '</script'; ?>
>
    </body>
</html><?php }
}
