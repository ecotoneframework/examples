<?php


namespace Example\Modelling\Intercepting\Around\TransactionInterceptor;

use Ecotone\Messaging\Annotation\Interceptor\Around;
use Ecotone\Messaging\Annotation\Interceptor\MethodInterceptor;
use Ecotone\Messaging\Handler\Processor\MethodInvoker\MethodInvocation;

/**
 * Class TransactionService
 * @package Example\Modelling\Intercepting\Around\Interceptor
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @MethodInterceptor()
 */
class TransactionService
{
    /**
     * @param MethodInvocation $methodInvocation
     * @return mixed
     *
     * @Around(pointcut="@(Example\Modelling\Intercepting\Around\TransactionInterceptor\StartTransaction)", precedence=0)
     */
    public function execute(MethodInvocation $methodInvocation)
    {
        echo "Starting transaction\n";

        $result = $methodInvocation->proceed();

        echo "Commiting transaction\n";

        return $result;
    }
}