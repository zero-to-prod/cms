# Server Side CMS Readme

## Continuous Integrations Tools
- StyleCi
- TravisCi

## Architecture Overview
There is a server side application that interfaces with a client side application through an API.

There is a common code base on the server side to handle code that is shared between two or more client side applications.

Every customer has its own sub domain and instance of a common code base on the server side.

Any functionality unique to that customer is contained in its own code base.

Schema Example 
```bash
# Single repo common to all customers
customer1.zero-to-prod.com/api/cms          # For common client side CMS
customer1.zero-to-prod.com/api              # For client side application

# Single repo unique to a single customer
customer1.custom.zero-to-prod.com/api/cms   # For unique customer requirements
customer1.custom.zero-to-prod.com/api       # For unique customer requirements
```

## Project Opinions
1. The root directory for models is `app/Models`
1. All slugs use `_`
    1. All URIs use `-`
1. A helper function is to be in its own file with a matching function name.
    
    Example filename:
    ```bash
    helper_function.php
    ```
    Example function:
    ```php
    <?php
    
    if(!function_exists('helper_function')){ 
        function helper_function(){
            return true;
        }
    }
    ```
1. 