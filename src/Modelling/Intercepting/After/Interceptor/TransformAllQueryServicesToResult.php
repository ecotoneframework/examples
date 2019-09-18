<?php


namespace Example\Modelling\Intercepting\After\Interceptor;

use Ecotone\Messaging\Annotation\Interceptor\After;
use Ecotone\Messaging\Annotation\Interceptor\MethodInterceptor;

/**
 * Class TransformToResult
 * @package Example\Modelling\Intercepting\After\Interceptor
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @MethodInterceptor()
 */
class TransformAllQueryServicesToResult
{
    /**
     * @param $endpointResult
     * @return array
     *
     * @After(pointcut="Example\Modelling\Intercepting\After\*QueryService")
     */
    public function transform($endpointResult) : array
    {
        echo "Transforming result into array\n";
        return [
            "result" => $endpointResult
        ];
    }
}