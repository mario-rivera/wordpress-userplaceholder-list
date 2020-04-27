<?php
namespace InpsydeTest\EndpointHandler;

use Psr\Http\Message\ResponseInterface;
use InpsydeTest\User\UserRepository;
use InpsydeTest\View\CustomEndpointView;

class TestEndpointHandler implements EndpointHandlerInterface
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var CustomEndpointView
     */
    private $view;

    public function __construct(
        ResponseInterface $response,
        UserRepository $userRepository,
        CustomEndpointView $view
    ) {
        $this->response = $response;
        $this->userRepository = $userRepository;
        $this->view = $view;
    }

    /**
     * @return ResponseInterface
     */
    public function handle(): ResponseInterface
    {
        $users = $this->userRepository->getUsers();
        
        /**
         * In a more traditional template rendering, I would pass the users data to the view
         * so that php would loop through the data and render some html
         * 
         * However I am going to let Vue do the call. 
         * I am only passing this data even though it is not used to illustrate how fetching the data from the backend would be like.
         * So, sorry for the overhead, but I want to be thorough with the test.
         */
        $content = $this->view->render(['users' => $users]);
        $this->response->getBody()->write($content);

        return $this->response;   
    }
}
