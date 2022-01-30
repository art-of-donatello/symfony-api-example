//*****    Documentation For Symfony Api   *****\\

***** Get Orders *****

    This function returns all orders with details.

    {YourURL}/api/getorders



***** EDIT ORDER *****

This function edits Order.

    edit:

    Status          : Status depends on this function. Works with Form-data (Post Method)   | string

    Usage:
    {YourURL}/api/updateorder
            Form-data: orderCode = orderCode
            Form-data: productId = productId
            Form-data: quantity = quantity
            Form-data: adress = adress
            Form-data: shippingDate = shippingDate


***** GET JWT TOKEN *****
    This function returns new Jwt Token for Api usage. You have to enter with login Credentials
    
    Usage:
    {YourURL}/auth/login?username=Username&password=Password
             Params:username=Username&password=Password





***** CREATE NEW USER *****
    This function returns new user. 
    
    Usage:
    {YourURL}/auth/register?username=test&password=12345&role=customer
             Params:username=Username
                    password=Password
                    role=customer