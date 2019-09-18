<?php


namespace Example\Modelling\Intercepting\After;

use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Modelling\Annotation\QueryHandler;

/**
 * Class ArticleService
 * @package Example\Modelling\Intercepting\After
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @MessageEndpoint()
 */
class ArticleQueryService
{
    /**
     * @return bool
     * @QueryHandler(inputChannelName="article.is_published", ignoreMessage=true)
     */
    public function isPublished() : bool
    {
        return true;
    }
}