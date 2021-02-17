<?php

class WebUser extends CWebUser {
    private $_model = null;
    private $_group = null;
    private $_department = null;
    private $_agent = null;
    private $_access;
    private $_identity;

    private function getModelDepartment(){
        if (!$this->isGuest && $this->_department === null){
            $this->_department = Department::model()->findByPk($this->profile->department);
        }
        return $this->_department;
    }

    private function getModelGroup(){
        if (!$this->isGuest && $this->_group === null){
            $this->_group = Groups::model()->findByPk($this->profile->user_group);
        }
        return $this->_group;
    }

    private function getModelAgent(){
        if (!$this->isGuest && $this->_agent === null){        	$this->_agent = CpAgent::model()->findByPk(1);
        } elseif(!$this->_department) {        	$this->_agent = CpAgent::model()->findByPk(2);        }
        return $this->_agent;
    }

    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = User::model()->with('group')->findByPk($this->id);
        }
        return $this->_model;
    }

    public function getProfile() {
		return $this->getModel();
	}
	public function getGroup() {
		return $this->getModelGroup();
	}

	public function getGroupId() {
		if(Yii::app()->user->isGuest) return -1;
		return $this->profile->group->id;
	}

	public function getDepartment() {
		return $this->getModelDepartment();
	}
	public function getAgent() {
		return $this->getModelAgent();
	}

	public function checkController()
	{
		$controller = Yii::app()->controller->id.'controller';
		$access = Access::model()->findAll(array('condition'=>'controller = "'.$controller.'" and group_id="'.$this->GroupId.'"'));
		$actions = array();
		foreach ((array) $access as $item)
		{
          $actions[] = $item->action;
		}
		//print_r($actions);
		//die();
		$username = $this->profile->username;
		if($this->GroupId == -1) $username = '*';
	    return array('allow',
				'actions'=>($actions?$actions:['xx']),
				'users'=>array($username),
			);
	}

	protected function loadAccess($group_id=null)
    {
        if($this->_access===null)
        {
            if($group_id!==null)
                $this->_access=Access::model()->cache(60*60)->findAll(array('condition'=>'group_id="'.$group_id.'"'));
        }
        return $this->_access;
    }

	public function isAllow()
	{
		$actions = array();
		foreach ((array) $this->loadAccess(isset($this->profile->group->id)?$this->profile->group->id:-1) as $item)
		{			//echo '<pre>'.print_r($item->attributes, 1).'</pre>';
			if($item->module) {				$actions[] = mb_strtolower($item->module.'/'.str_replace('Controller','',$item->controller).'/'.$item->action);			} else {
          		$actions[] = mb_strtolower(str_replace('Controller','',$item->controller).'/'.$item->action);
          	}
		}
		//var_dump($actions);
		$array = func_get_args( );
		foreach ((array) func_get_args( ) as $args)
		{
          if (in_array(mb_strtolower($args),$actions)) return true;
		}
		return false;
	}

	function getisAdmin(){
    	return $this->isAllow('admin/global/menu');
  	}

  	public function login($identity, $duration=0)
    {
        $this->_identity = $identity;
        return parent::login($identity, $duration);
    }

    protected function afterLogin($fromCookie)
    {
        if ($this->_identity !== null){
        	if(strtotime(Yii::app()->user->profile->regdate)<1900) {
        		$date = date('Y-m-d');
        	} else {
        		$date = Yii::app()->user->profile->regdate;
        	}
        }
        //$fh=fopen(Yii::getPathOfAlias('webroot').'/after_login.txt', 'w');
        //fwrite($fh, print_r(Yii::app()->phpBB->login($this->_identity->username, $this->_identity->password),true));
        //fclose($fh);
        //echo '<script>alert("Ура!!")</script>';
        parent::afterLogin($fromCookie);
    }

    protected function afterLogout()
    {    	//Yii::app()->user->setFlash('modal','Thank you for contacting us. We will respond to you as soon as possible.');
        //Yii::app()->phpBB->logout();
        parent::afterLogout();
    }
}
?>