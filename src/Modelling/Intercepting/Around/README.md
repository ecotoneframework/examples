# Example usage of around interceptor 

Around interceptor is called just before executing the method, when all parameters are already converted.
The interceptor has control over invocation of specific method and access to the invoked object.
This is good place for calling code, that need to be started before invocation and finished after e.g.
database transaction.