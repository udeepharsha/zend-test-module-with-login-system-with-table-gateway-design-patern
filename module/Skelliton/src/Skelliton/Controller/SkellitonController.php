<?php

namespace Skelliton\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SkellitonController extends AbstractActionController
{
    
    public function testAction(){
    	$message = $this->params()->fromQuery('message', 'foo');
        return new ViewModel(array('message' => $message));
    }

    public function indexAction(){
    	return new ViewModel();
    }
}
