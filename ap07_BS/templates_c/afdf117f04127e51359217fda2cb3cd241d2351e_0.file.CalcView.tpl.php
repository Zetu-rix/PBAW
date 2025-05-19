<?php
/* Smarty version 3.1.30, created on 2025-05-19 18:48:10
  from "C:\xampp\htdocs\ap05_BS\app\views\CalcView.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_682b60ca657211_39294712',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'afdf117f04127e51359217fda2cb3cd241d2351e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ap05_BS\\app\\views\\CalcView.tpl',
      1 => 1747673289,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
  ),
),false)) {
function content_682b60ca657211_39294712 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_800911415682b60ca656c72_96503173', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'content'} */
class Block_800911415682b60ca656c72_96503173 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<header>
    <h2>Kalkulator Kredytowy</h2>
</header>

<form action="<?php echo $_smarty_tpl->tpl_vars['action_url']->value;?>
calcCompute" >
    <div class="row">
        <div class="col-4 col-12-mobile">Kwota<br>
            <input type="text" name="kwota" placeholder="10000 PLN" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form']->value->kwota)===null||$tmp==='' ? '' : $tmp);?>
">
        </div>
        <div class="col-4 col-12-mobile">Lata<br>
            <input type="text" name="lata" placeholder="5 lat" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form']->value->lata)===null||$tmp==='' ? '' : $tmp);?>
">
        </div>
        <div class="col-4 col-12-mobile">Oprocentowanie<br>
            <input type="text" name="proc" placeholder="5 = 5%" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form']->value->proc)===null||$tmp==='' ? '' : $tmp);?>
">
        </div>
        <div class="col-12">
            <input type="submit" value="Oblicz" />
        </div>
    </div>
</form>

<div>
    <?php if ($_smarty_tpl->tpl_vars['msgs']->value->isError()) {?>
        <h4>Wystąpiły błędy:</h4>
        <ol class="err">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['msgs']->value->getErrors(), 'msg');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['msg']->value) {
?>
                <li><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</li>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </ol>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['msgs']->value->isInfo()) {?>
        <h4>Informacje:</h4>
        <ol class="inf">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['msgs']->value->getInfos(), 'msg');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['msg']->value) {
?>
                <li><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</li>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </ol>
    <?php }?>

    <?php if (isset($_smarty_tpl->tpl_vars['res']->value->result)) {?>
        <h4>Miesięczna rata:</h4>
        <p class="res"><?php echo $_smarty_tpl->tpl_vars['res']->value->result;?>
 PLN</p>
    <?php }?>
</div>

<?php
}
}
/* {/block 'content'} */
}
