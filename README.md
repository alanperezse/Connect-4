# Connect-4 Server
This Connect 4 web client is meant to be used in conjunction with the Connect 4 client made with Dart, also found on my github on its own repository.

This particular server specifies a board of width 7, and a height of 6. The strategies available to the player are Smart and Random.

A winner will be declared when 4 slots of the same player are placed adjacently (horizontally, vertically, or diagonally).

A tie will be declared when the board is full.

### PHP Scripts:
The PHP scripts can be run on a server, which must contain a writable directory where files will be created for every individual game. For testing the php on a local machine, we can simply do:

    php -S localhost:8000
    
on the src/ directory and this will create a local server that we can interact with.


### To play:
The server will get the user response using php _GET array. Responses by the server will be in JSON format, which can be interpreted by the Dart client provided in the client repository. Run the php server in localhost:8000 (or some other url), and then follow the indications from the Dart repository.
