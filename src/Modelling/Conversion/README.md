# Example usage of Conversion system using Command and Query Buses

When message comes from outside, it's serialized in specific format, like application/json.  
To release application from converting explicitly and burden model level code with infrastructure,   
Ecotone can do it automatically via registered Converter.   
It is done just before calling method, so the frameworks knows what is the expected type.   

Conversion is done via JMS Serializer