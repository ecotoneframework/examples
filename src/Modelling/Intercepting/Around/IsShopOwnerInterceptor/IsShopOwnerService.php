<?php


namespace Example\Modelling\Intercepting\Around\IsShopOwnerInterceptor;

use Ecotone\Messaging\Annotation\Interceptor\Around;
use Ecotone\Messaging\Annotation\Interceptor\MethodInterceptor;
use Example\Modelling\Intercepting\Around\Shop;

/**
 * Class IsShopOwnerService
 * @package Example\Modelling\Intercepting\Around\IsShopOwnerinterceptor
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @MethodInterceptor()
 */
class IsShopOwnerService
{
    const EXECUTOR_ID = 'executorId';

    /**
     * @param array $payload
     * @param array $metadata
     * @param Shop $shop
     *
     * @Around(pointcut="@(Example\Modelling\Intercepting\Around\IsShopOwnerInterceptor\IsExecutorShopOwner)", precedence=1)
     */
    public function check(array $payload, array $metadata, Shop $shop) : void
    {
        echo "Verifying if is shop owner\n";
        if (!$shop->isShopOwner($metadata[self::EXECUTOR_ID])) {
            throw new \InvalidArgumentException("Does not own the shop!");
        }
        echo "Shop owner check passed\n";
    }
}