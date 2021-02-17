<?php
class Files extends CFormModel {
    public $model_file;
    // другие свойства

    public function rules(){
        return array(
            //устанавливаем правила для файла, позволяющие загружать
            // только картинки!
            array('model_file', 'file', 'types'=>'mdl,stl'),
        );
    }
}
?>