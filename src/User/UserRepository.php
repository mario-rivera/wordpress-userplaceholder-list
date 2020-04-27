<?php
namespace InpsydeTest\User;

class UserRepository
{
    /**
     * @var UserClient
     */
    private $userClient;

    public function __construct(
        UserClient $userClient
    ) {
        $this->userClient = $userClient;   
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        /**
         * Note: In this case it is not doing more than wrapping a call to the API
         * but for example, this could return a Collection of User objects, or some other type of data
         * not exclusive to the client call so I think this class is a nice to have given those possibilities.
         */
        return $this->userClient->getUsers();
    }
}
