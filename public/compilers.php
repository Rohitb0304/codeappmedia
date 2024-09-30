<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Compiler</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Highlight.js for initial code styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/default.min.css">
    <!-- CodeMirror CSS for styling the editor -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/dracula.min.css">
    <!-- CodeMirror JavaScript for the editor functionality -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/clike/clike.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/javascript/javascript.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1c1c1c;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        header{
            width: 100%;
            background-color: #ffffff;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
        }
        
        footer {
            border-top: 1px solid #444444;
            margin-top: auto;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            padding: 20px;
            background-color: #2b2b2b;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            margin-top: 20px;
            position: relative;
        }
        .language-dropdown {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
        select, button, input {
            margin-bottom: 20px;
            padding: 12px;
            background-color: #333333;
            color: #e0e0e0;
            border: 1px solid #444444;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
        }
        textarea {
            height: 200px;
            resize: vertical;
            font-family: 'Fira Code', monospace;
            line-height: 1.5;
            color: #e0e0e0;
            background-color: #282c34;
            border: 1px solid #4e4e4e;
            overflow: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
            overflow-x: auto; /* Allow horizontal scroll for code */
        }
        button {
            background-color: #6200ea;
            border: none;
            color: #ffffff;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #3700b3;
        }
        .copy-code-btn {
            background-color: #444444;
            border: none;
            color: #ffffff;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            padding: 6px 12px;
            margin-top: 10px;
        }
        .copy-code-btn:hover {
            background-color: #666666;
        }
        .fa-copy {
            margin-right: 5px;
        }
    </style>
</head>
<body>    
    <div class="container">
        <div class="language-dropdown">
            <select id="language-selector">
                <option value="c">C Compiler</option>
                <option value="python">Python Compiler</option>
                <option value="javascript">JavaScript Compiler</option>
            </select>
            <button class="copy-code-btn" id="copy-code"><i class="fas fa-copy"></i> Copy Code</button>
        </div>
        <h1>Online Compiler</h1>
        
        <textarea id="code-input" class="code-editor">#include &lt;stdio.h&gt;

int main() {
    printf("Hello, World!\\n");
    return 0;
}</textarea>
        <input type="text" id="user-input" placeholder="Enter input for the program...">
        <button id="run-code">Run Code</button>
        
        <h2>Output</h2>
        <pre id="output"></pre>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script>
        const API_KEY = '414d4ead3dmshf5a3d5f6aef3ccbp107082jsncefc22bc80b3';
        const API_HOST = 'judge0-ce.p.rapidapi.com';

        // Pre-filled code for each language
        const codeSnippets = {
            'c': '#include <stdio.h>\n\nint main() {\n    printf("Hello, World!\\n");\n    return 0;\n}',
            'python': 'print("Hello, World!")',
            'javascript': 'console.log("Hello, World!");'
        };

        const codeInput = document.getElementById('code-input');
        const codeMirror = CodeMirror.fromTextArea(codeInput, {
            mode: 'text/x-csrc', // Default mode
            theme: 'dracula',
            lineNumbers: true,
            lineWrapping: true,
            autofocus: true
        });

        document.getElementById('language-selector').addEventListener('change', function() {
            const language = this.value;
            switch(language) {
                case 'c':
                    codeMirror.setOption('mode', 'text/x-csrc');
                    break;
                case 'python':
                    codeMirror.setOption('mode', 'text/x-python');
                    break;
                case 'javascript':
                    codeMirror.setOption('mode', 'text/javascript');
                    break;
                default:
                    codeMirror.setOption('mode', 'text/x-csrc'); // Default to C
            }
            codeMirror.setValue(codeSnippets[language]);
        });

        document.getElementById('run-code').addEventListener('click', function() {
            const language = document.getElementById('language-selector').value;
            const code = codeMirror.getValue();
            const userInput = document.getElementById('user-input').value;

            let languageId;
            switch(language) {
                case 'c': languageId = 50; break;
                case 'python': languageId = 71; break;
                case 'javascript': languageId = 62; break;
                default: languageId = 71;
            }

            // Submit code to Judge0
            fetch('https://judge0-ce.p.rapidapi.com/submissions/?base64_encoded=false', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'x-rapidapi-host': API_HOST,
                    'x-rapidapi-key': API_KEY
                },
                body: JSON.stringify({
                    source_code: code,
                    language_id: languageId,
                    stdin: userInput,
                    expected_output: ""
                })
            })
            .then(response => response.json())
            .then(data => {
                const token = data.token;
                return fetch(`https://judge0-ce.p.rapidapi.com/submissions/${token}?base64_encoded=false`, {
                    method: 'GET',
                    headers: {
                        'x-rapidapi-host': API_HOST,
                        'x-rapidapi-key': API_KEY
                    }
                });
            })
            .then(response => response.json())
            .then(result => {
                document.getElementById('output').textContent = result.stdout || result.stderr || 'No output';
            })
            .catch(error => {
                console.error('Error running code:', error);
                document.getElementById('output').textContent = 'Error executing code';
            });
        });

        document.getElementById('copy-code').addEventListener('click', function() {
            navigator.clipboard.writeText(codeMirror.getValue())
                .then(() => alert('Code copied to clipboard!'))
                .catch(err => console.error('Failed to copy code: ', err));
        });
    </script>
</body>
</html>