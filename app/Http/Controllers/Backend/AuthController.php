<?php

namespace App\Http\Controllers\Backend;

use Lib\Database\Connection;
use Lib\Framework\Http\Controller;
use Doctrine\ORM\Query;
use Database\Entities\User;

class AuthController extends Controller
{

    private $view;
    private $connection;
    private $entityManager;

    public function __construct($middleware, $twig)
    {
        parent::__construct($middleware, $twig);
        //
        $this->connection = new Connection;
        $this->entityManager = $this->connection->entityManager;
        $this->view = $twig;
    }

    public function index()
    {
        // Display all users from the DB
        $userRepository = $this->entityManager->getRepository('Database\Entities\User');
        $users = $userRepository->findAll();
        
        return $this->view->render('backend/partials/users.php', array('users' =>  $users));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    *
    */
    public function create()
    {
        return $this->view->render('backend/partials/register.twig.php');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    *
    */
    public function store()
    {
        $formVars = $this->request->getParsedBody();
        $name = $formVars['name'];
        $username = $formVars['username'];
        $email = $formVars['email'];
        $passwd = $formVars['passwd'];
        $userLevel = $formVars['userLevel'];

        $user = new User;
        $user->setName($name);
        $user->setUserName($username);
        $user->setEmail($email);
        $user->setPasswd($passwd);
        $user->setUserLevel($userLevel);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
        
    //    return $this->view->render('backend/partials/users.php', array('users' =>  $users));
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
        //
    }
 
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
            //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        //
    }
 
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
            //
    }
}