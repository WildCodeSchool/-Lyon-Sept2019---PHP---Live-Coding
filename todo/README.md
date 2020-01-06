1. clone Repository
2. Set your `DATABASE_URL` in `.env.test.local` file (this file will be used when running tests, therefore you can use a different database for your tests)
3. `composer install`
4. `php bin/console doctrine:database:create`
5. `php bin/console doctrine:migration:migrate`

**NB**: Run your tests by executing: `php bin/phpunit`

## I. Unit Tests

### Prerequisites

1. Create a new service `TodoManager`
2. In this service, create 2 methods : `checkAll()` and `uncheckAll()`
   - This should respectively update all todos with `isDone = true` and `isDone = false`

### Testing

1. Create a TodoManagerTest  class in `src/tests/Service` (all the following test* methods will be implemented in that class)
2. In a method `testCreateTodo()` :
   - Create and persist 10 Todo Entities
   - Assert that todos total count is 10
   - Assert that all todos are set with `isDone = false`
3. In a method `testCheckAll()`, Instantiate a service `TodoManager` and:
   - Assert that all todos are done after calling `todoManager->checkAll()`

4. In a method `testUncheckAll()`, Instantiate a service `TodoManager` and:
   - Assert that all todos are undone after calling `todoManager->uncheckAll()`

## II. Functional Tests

Resources: https://symfony.com/doc/current/testing.html#functional-tests

### Prerequisites

1. Install Symfony Panther : https://github.com/symfony/panther
   - `composer req --dev symfony/panther`

### Testing

1. Create a TodoControllerTest in `src/tests/Controller` (all the following test* methods will be implemented in that class)
2. In a method `testTodos()` :
   - Assert that URL `/todo/` HTTP Return Status is 200
   - Assert that you have 10 `<tr/>` on the page reprensenting the todos
   - Select the link "Create New" 
   - Click on Link "Create New"
   - Assert that the title "Create new Todo" is displayed on the page
   - Fill in Form: 
     - Todo title = "New Todo checked"
     - isDone = checked
   - Assert that you have been redirected to `/todo/`
   - Assert that you now have 11 `<tr/>` displayed