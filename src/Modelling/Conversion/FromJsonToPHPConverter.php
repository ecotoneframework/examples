<?php


namespace Example\Modelling\Conversion;

use Ecotone\Messaging\Annotation\MediaTypeConverter;
use Ecotone\Messaging\Conversion\Converter;
use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Messaging\Handler\TypeDescriptor;
use JMS\Serializer\SerializerBuilder;

/**
 * Class JsonConverter
 * @package Ecotone\Amqp\Conversion
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @MediaTypeConverter()
 */
class FromJsonToPHPConverter implements Converter
{
    /**
     * @inheritDoc
     */
    public function convert($source, TypeDescriptor $sourceType, MediaType $sourceMediaType, TypeDescriptor $targetType, MediaType $targetMediaType)
    {
        $serializer = SerializerBuilder::create()->build();

        return $serializer->deserialize($source, $targetType->getTypeHint(), "json");
    }

    /**
     * @inheritDoc
     */
    public function matches(TypeDescriptor $sourceType, MediaType $sourceMediaType, TypeDescriptor $targetType, MediaType $targetMediaType): bool
    {
        return $sourceMediaType->isCompatibleWithParsed(MediaType::APPLICATION_JSON)
            && $targetMediaType->isCompatibleWithParsed(MediaType::APPLICATION_X_PHP_OBJECT);
    }
}