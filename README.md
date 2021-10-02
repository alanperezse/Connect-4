# Connect-4
This Connect 4 has two major components; the PHP scripts, and the Java client.

### PHP Scripts:
The PHP scripts can be run on a server, which must contain a writable directory where files will be created for every individual game.

To get general info about the game of Connect-4, visit the /info directory.

To start a new game, visit the /new directory and provide a 'Random' or 'Smart' strategy as a URL parameter. For instance, /new/?strategy=Smart would be a valid URL. The script will then print a json string containing a valid pid (among other information) to the screen that the client should use to keep playing the same instance of a game.

To play, visit the /play directory and provide a valid pid and a valid move as a URL parameter, where the move is a column in which to play the disk put by the player. For instance, /play/?pid={pid provided}&move=0 would be a valid URL at the start of the game. The script will then print a json string containing the general state of the game and the move done by the machine.

Some important rules about the game is that a valid move is 0 <= slot < width, where width is the number of columns in the game. A move is only valid if there is space left for the disk in the selected column.

### Java client
The java client is important for providing a GUI where the user can play the game. The implementation was provided by Dr. Cheon from The University of Texas at El Paso.

### To play:
The user must select the settings icon and provide the URL where the server is hosted (it assumes that the URL contains the directories play, new, and info). Once this is done, you may connect to the server by clicking on the network icon.

The final step for playing the game is to select a strategy from the list, and click on the play button. Placing disks is done by clicking on the blue disks at the top of the columns.
