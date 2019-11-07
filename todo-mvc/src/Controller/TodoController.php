<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;
use App\Model\TodoManager;

class TodoController extends AbstractController
{
    /**
     * Display todo list
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function list()
    {
        $todoManager = new TodoManager();
        $todos = $todoManager->selectAll();

        return $this->twig->render('Todo/list.html.twig', [
            'todos' => $todos
        ]);
    }

    public function create()
    {
        if (!empty($_POST)) {
            $todo = [
                "content" => trim($_POST['content']),
            ];
            $todoManager = new TodoManager();
            $todoManager->insert($todo);
        }
        return header('location: /todo/list');
    }

    public function edit(int $id): string
    {
        $todoManager = new TodoManager();
        $todo = $todoManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $todo['content'] = $_POST['content'];
            $todoManager->update($todo);
            header('location: /todo/list');
        }

        return $this->twig->render('Todo/edit.html.twig', ['todo' => $todo]);
    }

    public function delete(int $id)
    {
        if (!empty($_POST) && isset($_POST['delete'])) {
            $todoManager = new TodoManager(); 
            $todoManager->delete($id);
        }
        return header('location: /todo/list');
    }
}
