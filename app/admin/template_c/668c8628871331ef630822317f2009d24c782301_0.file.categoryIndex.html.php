<?php
/* Smarty version 3.1.32, created on 2025-06-30 13:31:15
  from '/Users/hollie/Project/smarty/app/admin/view/category/categoryIndex.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_686221230f5954_69370391',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '668c8628871331ef630822317f2009d24c782301' => 
    array (
      0 => '/Users/hollie/Project/smarty/app/admin/view/category/categoryIndex.html',
      1 => 1751260930,
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
function content_686221230f5954_69370391 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>博客后台</title>
    <link rel="stylesheet" type="text/css" href="/admin/css/app.css" />
    <style>
        /* 分類列表專用樣式 */
        body.admin-page {
            background: #f8fafc;
            display: block;
            height: auto;
        }
        
        .simplebox {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px;
        }
        
        .titleh {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 25px;
        }
        
        .titleh h3 {
            color: white;
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }
        
        .tablesorter {
            width: 100%;
            border-collapse: collapse;
        }
        
        .tablesorter thead th {
            background: #f8fafc;
            color: #374151;
            font-weight: 600;
            padding: 15px 20px;
            text-align: left;
            border-bottom: 2px solid #e5e7eb;
            font-size: 14px;
        }
        
        .tablesorter tbody td {
            padding: 15px 20px;
            border-bottom: 1px solid #f3f4f6;
            color: #1f2937;
            font-size: 14px;
        }
        
        .tablesorter tbody tr:hover {
            background: #f0f9ff;
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }
        
        .tablesorter tbody tr:nth-child(even) {
            background: #fafafa;
        }
        
        .tablesorter tbody tr:nth-child(even):hover {
            background: #f0f9ff;
        }
        
        .tablesorter tbody td a {
            display: inline-block;
            padding: 6px 12px;
            margin-right: 8px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .tablesorter tbody td a:first-child {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: #fff;
        }
        
        .tablesorter tbody td a:first-child:hover {
            background: linear-gradient(135deg, #ee5a24, #c44569);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(238, 90, 36, 0.3);
        }
        
        .tablesorter tbody td a:last-child {
            background: linear-gradient(135deg, #26de81, #20bf6b);
            color: #fff;
        }
        
        .tablesorter tbody td a:last-child:hover {
            background: linear-gradient(135deg, #20bf6b, #0be881);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(32, 191, 107, 0.3);
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 20px 0;
            margin: 0;
            background: #f8fafc;
            border-top: 1px solid #e5e7eb;
        }
        
        .pagination li {
            margin: 0 3px;
        }
        
        .pagination li a {
            display: block;
            padding: 8px 12px;
            color: #6b7280;
            text-decoration: none;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            transition: all 0.3s ease;
        }
        
        .pagination li a:hover {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            border-color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
        }
        
        .page-title {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 25px 30px;
        }
        
        .page-title .titlebar h2 {
            color: #1f2937;
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 5px 0;
        }
        
        .page-title .titlebar p {
            color: #6b7280;
            font-size: 16px;
            margin: 0;
        }
        
        .content {
            padding: 0;
        }
    </style>
</head>
<body class="admin-page">
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
            <!-- start page title -->
             <div class="page-title">
                <div class="in">
                    <div class="titlebar">
                        <h2>分類管理</h2>
                        <p>分類列表</p>
                    </div>
                    <div class="clear"></div>
                </div>
             </div>
             <!-- end page title -->

             <!-- start content -->
              <div class="content">
                <div class="simplebox grid740" style="z-index: 720;">
                    <div class="titleh" stylle="z-index:710">
                        <h3>分類列表</h3>
                    </div>
                    <!-- start table -->
                    <table id="myTable" class="tablesorter">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>名稱</th>
                                <th>下屬博文數量</th>
                                <th>排序</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_SESSION['categories'], 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['cat']->value['name'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['cat']->value['sort'];?>
</td>
                                <td>10</td>
                                <td>
                                    <a href="#">刪除</a>
                                    <a href="#">編輯</a>
                                </td>
                            </tr>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                        </thead>
                    </table>
                    <ul class="pagination">
                        <li><a href="#">上一頁</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">6</a></li>
                        <li><a href="#">7</a></li>
                        <li><a href="#">8</a></li>
                        <li><a href="#">9</a></li>
                        <li><a href="#">下一頁</a></li>
                    </ul>
                </div>
                <!-- END TABLE -->
            </div>
            <!-- end content -->
        </div>
        <!-- end page -->
        <div class="clear"></div>
    </div>
    <!-- END MAIN -->

    <!-- START FOOTER -->
    <?php $_smarty_tpl->_subTemplateRender("file:../Public/footert.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <!-- END FOOTER -->
</div>
</body>
</html><?php }
}
