<?php

$this->breadcrumbs=array(
	Yii::app()->getModule('admin')->name=>array('/admin/global/index'),
	'Список групп пользователей'=>array('/admin/user/index'),
	'Правка',
);


?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'enableAjaxValidation'=>true,
)); ?>

<table class="table-choc border">
<tr>
        <td class="header" colspan=2>Пользователь  <?=$model->username?></td>
</tr>
<tr>
        <td class="row" colspan=2>
            <p class="note">Поля отмеченные <span class="required">*</span> обязательны к заполнению.</p>
            <?php echo $form->errorSummary($model); ?>
        </td>
</tr>
    <tr>
        <td>
            <?php echo $form->labelEx($model,'username'); ?>
        </td>
        <td>
            <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128)); ?>
            <br>
            <?php echo $form->error($model,'username'); ?>
        </td>
    </tr>

    <tr>
        <td>
            <?php echo $form->labelEx($model,'activate'); ?>
        </td>
        <td>
            <?php echo $form->textField($model,'activate',array('size'=>34,'maxlength'=>34)); ?>
            <br>
            <?php echo $form->error($model,'activate'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php echo $form->labelEx($model,'group_id'); ?>
        </td>
        <td>
            <?php
            	echo $form->dropDownList($model,'group_id',CHtml::listData(Group::model()->findAll(), 'id', 'name'));
            //echo $form->textField($model,'group_id');
            ?>
            <br>
            <?php echo $form->error($model,'group_id'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php echo $form->labelEx($model,'email'); ?>
        </td>
        <td>
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
            <br>
            <?php echo $form->error($model,'email'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php echo $form->labelEx($model,'banned'); ?>
        </td>
        <td>
            <?php echo $form->textField($model,'banned'); ?>
            <br>
            <?php echo $form->error($model,'banned'); ?>
        </td>
    </tr>
    <tr>
        <td class="footer" colspan=2>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
        </td>
    </tr>
</table>
<?php $this->endWidget(); ?>
<!-- form -->