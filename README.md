# Connect-4
This Connect 4 web client is meant to be used in conjunction with the Connect 4 client made with Dart, also found on my github on its own repository.

### PHP Scripts:
The PHP scripts can be run on a server, which must contain a writable directory where files will be created for every individual game. For testing the php on a local machine, we can simply do:

    php -S localhost:8000
    
on the src/ directory and this will create a local server that we can interact with.


### To play:
The server will get the user response using php _GET array. Responses by the server will be in JSON format, which can be interpreted by the Dart client provided in the client repository.
