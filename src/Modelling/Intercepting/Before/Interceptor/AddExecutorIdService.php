<?php


namespace Example\Modelling\Intercepting\Before\Interceptor;

use Ecotone\Messaging\Annotation\Interceptor\Before;
use Ecotone\Messaging\Annotation\Interceptor\MethodInterceptor;

/**
 * Class AdminService
 * @package Example\Modelling\Intercepting\Before
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @MethodInterceptor()
 */
class AddExecutorIdService
{
    const CURRENTLY_LOGGED_PERSON_ID = 1;

    /**
     * @param array $payload
     * @param AddExecutorId $addExecutorId
     * @return array
     *
     * @Before(pointcut="@(Example\Modelling\Intercepting\Before\Interceptor\AddExecutorId)")
     */
    public function add(array $payload, AddExecutorId $addExecutorId) : array
    {
        $payload[$addExecutorId->underKey] = self::CURRENTLY_LOGGED_PERSON_ID;

        return $payload;
    }
}