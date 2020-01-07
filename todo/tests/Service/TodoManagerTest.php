<?php

namespace App\Tests\Service;

use App\Entity\Todo;
use App\Service\TodoManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TodoManagerTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */

    private $entityManager;
    private $todoRepository;
    private $todoManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->todoRepository = $this->entityManager->getRepository(Todo::class);
        $this->todoManager = new TodoManager($this->todoRepository);
    }

    public function testCreateTodos()
    {
        $todos = $this->todoRepository->findAll();

        $this->assertCount(10, $todos);

        $this->assertEmpty($this->todoRepository->findBy(['isDone' => true]));
    }

    public function testCheckAll()
    {
        $this->todoManager->checkAll();
        $this->assertEmpty($this->todoRepository->findBy(['isDone' => false]));
    }

    public function testUncheckAll()
    {
        $this->todoManager->checkAll();
        $this->todoManager->uncheckAll();
        $this->assertEmpty($this->todoRepository->findBy(['isDone' => true]));
    }
}