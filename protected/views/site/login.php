<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = 'Вход';
$this->breadcrumbs = array(
    'Login',
);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => false,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array('class' => 'form-signin')
        ));
?>
<h2>Вход</h2>

<?if($model->hasErrors()):?>
    <div class="alert alert-error">

	<?php echo $form->errorSummary($model,'',''); ?>
    
    </div>
<? endif;?>

<?php echo $form->textField($model, 'username', array('placeholder' => 'Логин', 'class' => 'input-block-level')); ?>



<?php echo $form->passwordField($model, 'password', array('placeholder' => 'Пароль', 'class' => 'input-block-level')); ?>



<?php echo CHtml::submitButton('Вход', array('class' => 'btn  btn-primary')); ?>


<?php $this->endWidget(); ?>
<!-- form -->
