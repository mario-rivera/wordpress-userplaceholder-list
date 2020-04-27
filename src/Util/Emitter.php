<?php
namespace InpsydeTest\Util;

use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use Psr\Http\Message\ResponseInterface;

class Emitter
{
    /**
     * @var SapiEmitter
     */
    private $emitter;

    public function __construct(
        SapiEmitter $emitter
    ) {
        $this->emitter = $emitter;
    }

    /**
     * @param ResponseInterface $response
     * @return void
     */
    public function emit(ResponseInterface $response): void
    {
        $this->emitter->emit($response);

        /**
         * NOTE: I absolutely do not like to have to resort to the exit statement.
         * I must say that this is due to my current limitations in thorough Wordpress internal workings knowledge.
         * I assesed that the best way of hooking into the task was using parse_request but could't find how to stop wordpress processing
         * stages in an alternative way.
         * 
         * I would ask about this in an interview. Thanks.
         */
        exit;        
    }
}
