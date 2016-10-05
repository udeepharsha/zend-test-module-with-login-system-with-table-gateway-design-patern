<?php
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Model\Album;
use Album\Form\AlbumForm;

use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

class AlbumController extends AbstractActionController
{
    protected $albumTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'albums' => $this->getAlbumTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new AlbumForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $album = new Album();
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $album->exchangeArray($form->getData());
                $this->getAlbumTable()->saveAlbum($album);

                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }
        return array('form' => $form);
    }

    public function testAction(){
        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        echo '<h1>hasIdentity = ' . $auth->hasIdentity() . '</h1>';

        $config = $this->getServiceLocator()->get('Config');
        $acl = new \Auth\Acl\Acl($config);
        $role = \Auth\Acl\Acl::DEFAULT_ROLE;

        $usr = $auth->getIdentity();
        $usrl_id = $usr->usrl_id;

        $user_id = $usrl_id;

        switch ($usrl_id) {
            case 1 :
                $role = 'admin'; // guest
                break;
            case 2 :
                $role = 'member';
                break;
            default :
                $role = \Auth\Acl\Acl::DEFAULT_ROLE; // guest
                break;
        }
      
        $controller = $this->params()->fromRoute('controller');
        $action = $this->params()->fromRoute('action');
        
        echo '<pre>';
        echo "controller = " . $controller . "\n";
        echo "action = " . $action . "\n";
        echo "role = " . $role . "\n";
        echo '</pre>';
        
        if (!$acl->hasResource($controller)) {
            throw new \Exception('Resource ' . $controller . ' not defined');
        }
        
        echo '<h1> Acl answer: ' . $acl->isAllowed($role, $controller, $action) . '</h1>';

        if (!$acl->isAllowed($role, $controller, $action)) {
            echo "Not Allowed";
            //return $this->redirect()->toRoute('auth/default', array('controller' => 'index', 'action' => 'login'));
        }
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album', array(
                'action' => 'add'
            ));
        }
        $album = $this->getAlbumTable()->getAlbum($id);

        $form  = new AlbumForm();
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getAlbumTable()->saveAlbum($form->getData());

                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getAlbumTable()->deleteAlbum($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('album');
        }

        return array(
            'id'    => $id,
            'album' => $this->getAlbumTable()->getAlbum($id)
        );
    }

    public function getAlbumTable()
    {
        if (!$this->albumTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Album\Model\AlbumTable');
        }
        return $this->albumTable;
    }
}