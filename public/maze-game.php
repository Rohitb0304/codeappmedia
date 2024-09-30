<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maze-Game</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
            padding: 0;
            background-color: #f0f0f0;
            color: #333;
        }

        h1 {
            margin: 20px;
            color: #222;
            font-size: 28px;
        }

        .maze-error, .maze-success {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ff4d4d;
            color: #ffffff;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            z-index: 1000;
        }

        .maze-success {
            background-color: #4dff4d;
        }

        #instructions {
            max-width: 80%;
            margin: 0 auto 20px auto;
            background-color: #ffffff;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            color: #333;
            text-align: left;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        #minimize-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            color: #333;
            font-size: 18px;
            cursor: pointer;
        }

        #maze {
            display: grid;
            grid-template-columns: repeat(10, 60px);
            grid-template-rows: repeat(10, 60px);
            gap: 1px;
            justify-content: center;
            margin: 20px auto;
            position: relative;
            width: 100%;
            max-width: 606px;
            background-color: #ffffff;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .cell {
            width: 60px;
            height: 60px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }

        .wall {
            background-color: #ccc;
        }

        .path {
            background-color: #e0e0e0;
        }

        #mouse {
            width: 60px;
            height: 60px;
            position: absolute;
            background: none;
            font-size: 40px;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }

        .start, .end {
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .start {
            color: #4dff4d;
        }

        .end {
            color: #ff4d4d;
        }

        .command-editor {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        /* Indexed command lines */
        .command-line {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            position: relative;
            border-left: 2px solid #007acc;
            padding-left: 40px; /* Space for line number */
            font-family: monospace; /* Text editor-like font */
        }

        .command-line::before {
            content: attr(data-index) "";
            position: absolute;
            left: 10px;
            color: #333;
            font-weight: bold;
            font-size: 14px;
            display: inline-block; /* Ensures the index appears as an inline block */
        }

        /* Hide the index if the data-index attribute is empty */
        .command-line[data-index="0"]::before {
            content: "";
            display: none;
        }

        .command-input {
            width: 300px;
            padding: 10px;
            margin-right: 10px;
            background-color: #f9f9f9;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: Arial, sans-serif;
        }

        .run-button {
            padding: 10px;
            background-color: #007acc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .run-button:hover {
            background-color: #005ea1;
        }

        .styled-button {
            padding: 10px 20px;
            margin: 10px;
            background-color: #007acc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .styled-button:hover {
            background-color: #005ea1;
        }
    </style>
</head>
<body>
    <h1 id="gamename">Maze Puzzle Game</h1>
    <div id="instructions">
        <button id="minimize-btn" onclick="toggleInstructions()"><i class="fas fa-minus"></i></button>
        <h2>Instructions</h2>
        <p>Welcome to the Maze Puzzle Game! Your goal is to navigate the cat through the maze using command lines. Each command you enter will move the cat in a specific direction. Here’s how to use the command lines:</p>
        <div class="instructions-content">
            <p><strong>Commands:</strong></p>
            <ul>
                <li><code>mouse.moveRight(n)</code>: Move the cat right by <code>n</code> cells. Example: <code>mouse.moveRight(3)</code> moves the cat 3 cells to the right.</li>
                <li><code>mouse.moveDown(n)</code>: Move the cat down by <code>n</code> cells. Example: <code>mouse.moveDown(2)</code> moves the cat 2 cells down.</li>
                <li><code>mouse.moveLeft(n)</code>: Move the cat left by <code>n</code> cells. Example: <code>mouse.moveLeft(1)</code> moves the cat 1 cell to the left.</li>
                <li><code>mouse.moveUp(n)</code>: Move the cat up by <code>n</code> cells. Example: <code>mouse.moveUp(4)</code> moves the cat 4 cells up.</li>
            </ul>
            <p><strong>Rules:</strong></p>
            <ul>
                <li>The maze consists of paths and walls. The cat can only move through the paths.</li>
                <li>If the cat encounters a wall, it will stop and display an error message. You must adjust your commands to avoid walls.</li>
                <li>The maze is designed to have a specific exit point. The goal is to navigate the cat to this exit point using the commands provided.</li>
                <li>You can add multiple command lines to build a sequence of moves. Each command line should be entered separately.</li>
                <li>Use the <strong>Add Command Line</strong> button to add more command fields. Use the <strong>Run</strong> button next to each command line to execute the commands one by one.</li>
                <li>Once all commands are entered and ready, click the <strong>Start Maze</strong> button to execute all commands in sequence and navigate the maze.</li>
            </ul>
            <p><strong>Tips:</strong></p>
            <ul>
                <li>Double-check your commands for typos or errors before running them.</li>
                <li>Experiment with different sequences of commands to find the best path through the maze.</li>
                <li>Pay attention to the maze layout. The arrangement of walls and paths may change with different levels or challenges.</li>
            </ul>
        </div>
    </div>
    <div id="maze"></div>
    <div class="command-editor">
        <div class="command-line">
            <input type="text" class="command-input" placeholder="Enter command">
            <button class="run-button" onclick="executeCommand(this)">Run</button>
        </div>
    </div>
    <button class="styled-button" onclick="addCommandLine()">Add Command Line</button>
    <button class="styled-button" onclick="startMaze()">Start Maze</button>

    <div id="maze-success" class="maze-success" style="display: none;">Maze Completed!</div>

    <div id="command-editor"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const mazeContainer = document.getElementById('maze');
    const mazeSuccessElement = document.getElementById('maze-success');
    let maze = [];
    let mousePosition = { x: 0, y: 0 }; // Track mouse position
    let commandLineCount = 1; // Line number counter

    function createMaze() {
        maze = Array(10).fill().map(() => Array(10).fill(1)); // Start with all walls
        carveMaze(0, 0); // Start carving from the top-left corner

        // Ensure the end point is open
        maze[9][9] = 0;

        // Randomly open either the cell above or to the left of the end cell
        if (Math.random() < 0.5) {
            if (9 - 1 >= 0) maze[9 - 1][9] = 0; // Open cell above end
        } else {
            if (9 - 1 >= 0) maze[9][9 - 1] = 0; // Open cell to the left of end
        }

        // Render maze
        mazeContainer.innerHTML = ''; // Clear any existing cells
        for (let i = 0; i < 10; i++) {
            for (let j = 0; j < 10; j++) {
                const cell = document.createElement('div');
                cell.className = 'cell';
                if (maze[i][j] === 1) {
                    cell.classList.add('wall');
                } else {
                    cell.classList.add('path');
                }

                // Add start and end point markers
                if (i === 0 && j === 0) {
                    cell.classList.add('start');
                    cell.textContent = 'Start'; // Label for start
                } else if (i === 9 && j === 9) {
                    cell.classList.add('end');
                    cell.textContent = 'End'; // Label for end
                }

                mazeContainer.appendChild(cell);
            }
        }

        // Add the mouse (cat icon) at the initial position
        const mouseElement = document.createElement('div');
        mouseElement.id = 'mouse';
        mouseElement.innerHTML = '<i class="fas fa-cat"></i>'; // FontAwesome cat icon
        mazeContainer.appendChild(mouseElement);
        updateMousePosition(0, 0); // Set initial position
    }

    function carveMaze(x, y) {
        const directions = [[1, 0], [-1, 0], [0, 1], [0, -1]]; // Directions: right, left, down, up
        const shuffledDirections = directions.sort(() => Math.random() - 0.5); // Randomize directions

        for (const [dx, dy] of shuffledDirections) {
            const nx = x + dx * 2;
            const ny = y + dy * 2;
            if (nx >= 0 && nx < 10 && ny >= 0 && ny < 10 && maze[nx][ny] === 1) {
                maze[x + dx][y + dy] = 0; // Open the path
                maze[nx][ny] = 0; // Open the cell
                carveMaze(nx, ny); // Recursively carve from the new cell
            }
        }
    }

    function ensureValidMove(x, y) {
        return x >= 0 && x < 10 && y >= 0 && y < 10 && maze[x][y] === 0;
    }

    function updateMousePosition(x, y) {
        mousePosition = { x, y };
        const mouseElement = document.getElementById('mouse');
        mouseElement.style.transform = `translate(${y * 60}px, ${x * 60}px)`;

        // Check if the mouse reached the end
        if (x === 9 && y === 9) {
            mazeSuccessElement.style.display = 'block';
            setTimeout(() => {
                mazeSuccessElement.style.display = 'none';
            }, 3000);
        }
    }

    function showError(message) {
        const existingAlertBox = document.querySelector('.maze-error');
        if (existingAlertBox) {
            document.body.removeChild(existingAlertBox);
        }
        
        const alertBox = document.createElement('div');
        alertBox.className = 'maze-error';
        alertBox.textContent = message;
        document.body.appendChild(alertBox);

        console.error(message); // Log the error message to the console

        setTimeout(() => {
            alertBox.style.display = 'none';
            document.body.removeChild(alertBox);
        }, 5000); // Display for 5 seconds
    }

    window.executeCommand = function(button) {
        const input = button.previousElementSibling;
        const command = input.value.trim();

        if (!command) return;

        const match = command.match(/mouse\.(moveRight|moveLeft|moveUp|moveDown)\((\d+)\)/);
        if (!match) {
            showError('Invalid command');
            return;
        }

        const [, direction, stepsStr] = match;
        const steps = parseInt(stepsStr, 10);
        let newX = mousePosition.x;
        let newY = mousePosition.y;

        for (let i = 0; i < steps; i++) {
            if (direction === 'moveRight') newY++;
            if (direction === 'moveLeft') newY--;
            if (direction === 'moveUp') newX--;
            if (direction === 'moveDown') newX++;

            if (!ensureValidMove(newX, newY)) {
                showError('Ouchh.. The Cat hit a wall!.');
                return;
            }
        }

        updateMousePosition(newX, newY);
    };

    window.addCommandLine = function() {
        const commandEditor = document.querySelector('.command-editor');
        const commandLine = document.createElement('div');
        commandLine.className = 'command-line';
        commandLine.setAttribute('data-index', commandLineCount); // Set line number
        commandLine.innerHTML = `
            <input type="text" class="command-input" placeholder="Enter command">
            <button class="run-button" onclick="executeCommand(this)">Run</button>
        `;
        commandEditor.appendChild(commandLine);
        commandLineCount++; // Increment line number for the next line
    };

    window.startMaze = function() {
        const commandInputs = document.querySelectorAll('.command-input');
        for (const input of commandInputs) {
            const command = input.value.trim();
            if (command) {
                const button = input.nextElementSibling;
                executeCommand(button);
            }
        }
    };

    createMaze();
});

function toggleInstructions() {
    const instructions = document.getElementById('instructions');
    const minimizeBtn = document.getElementById('minimize-btn');

    if (instructions.style.display === 'none' || instructions.style.display === '') {
        // Show the instructions
        instructions.style.display = 'block';
        instructions.style.opacity = '1'; // Make it fully visible
        minimizeBtn.innerHTML = '<i class="fas fa-minus"></i>'; // Change to minus icon
    } else {
        // Hide the instructions
        instructions.style.display = 'none';
        minimizeBtn.innerHTML = '<i class="fas fa-plus"></i>'; // Change to plus icon
    }
}

    </script>
</body>
</html>