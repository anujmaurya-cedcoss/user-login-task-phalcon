<?php
use Phalcon\Mvc\Controller;

class SignupController extends Controller
{
    public function IndexAction()
    {
        // nothing here
    }

    public function registerAction()
    {
        // creating a new user, with name and email obtained by post method
        $user = new Users();
        $user->assign(
            $this->request->getPost(),
            [
                'name',
                'email',
                'password'
            ]
        );
        // if the user details is saved, then return success
        $success = $user->save();
        $this->session->set('user-name', $user->email);
        echo "<pre>";
        print_r($this->session->get('user-name'));
        $this->view->success = $success;
        if ($success) {
            $this->view->message = "Register succesfully";
        } else {
            $this->view->message = "Not Register due to following reason: <br>" . implode("<br>", $user->getMessages());
        }
    }
}
