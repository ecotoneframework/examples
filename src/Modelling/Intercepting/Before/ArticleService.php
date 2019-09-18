<?php


namespace Example\Modelling\Intercepting\Before;

use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Modelling\Annotation\CommandHandler;
use Ecotone\Modelling\Annotation\QueryHandler;
use Example\Modelling\Intercepting\Before\Interceptor\AddExecutorId;

/**
 * Class ArticleService
 * @package Example\Modelling\Intercepting\Before
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @MessageEndpoint()
 */
class ArticleService
{
    /**
     * @var array
     */
    private $publishedArticles = [];

    /**
     * @param array $payload
     *
     * @AddExecutorId(underKey="publisherId")
     * @CommandHandler(inputChannelName="article.publish")
     */
    public function publish(array $payload) : void
    {
        $this->publishedArticles[] = $payload;
    }

    /**
     * @return array
     * @QueryHandler(inputChannelName="article.get_all", ignoreMessage=true)
     */
    public function getArticles() : array
    {
        return $this->publishedArticles;
    }
}