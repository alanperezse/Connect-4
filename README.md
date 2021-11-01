# Connect-4
This Connect 4 has two major components; the PHP scripts, and the Dart client.

### PHP Scripts:
The PHP scripts can be run on a server, which must contain a writable directory where files will be created for every individual game. For testing the php on a local machine, we can simply do:

    php -S localhost:8000
    
on the src/ directory and this will create a local server that we can interact with.

### Dart client
The java client is important for providing a GUI where the user can play the game. Currently, since I was employing a server provided by my professor, the client does not properly highlight the winning coordinates. This needs to be fixed.

### To play:
The user must select start the server, and start the Dart project from IntelliJ idea. The user will be prompted for a URL, which should be the URL where the server was started (for instance, http://localhost:8000). A strategy must then be specified. The final step is to simply select columns until the game ends!
