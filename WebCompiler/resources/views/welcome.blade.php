<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>PHP Web Compiler</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    height:100vh;
    background:#0f172a;
    font-family:'Segoe UI',sans-serif;
    overflow:hidden;
}

.container{
    display:flex;
    height:100vh;
}

/* LEFT SIDE */

.editor-section{
    width:50%;
    display:flex;
    flex-direction:column;
    background:#111827;
    border-right:1px solid #1f2937;
}

.topbar{
    height:65px;
    background:#0b1220;
    border-bottom:1px solid #1f2937;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 25px;
}

.logo{
    color:white;
    font-size:20px;
    font-weight:700;
}

.logo span{
    color:#38bdf8;
}

.controls{
    display:flex;
    gap:10px;
}

.run-btn{
    background:#22c55e;
    color:white;
    border:none;
    padding:10px 22px;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
    transition:.2s;
}

.run-btn:hover{
    transform:translateY(-2px);
}

.clear-btn{
    background:#ef4444;
    color:white;
    border:none;
    padding:10px 22px;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
}

.editor-wrapper{
    flex:1;
    padding:20px;
}

textarea{
    width:100%;
    height:100%;
    background:#0f172a;
    color:#e5e7eb;
    border:1px solid #1f2937;
    border-radius:12px;
    outline:none;
    resize:none;
    padding:25px;
    font-size:15px;
    line-height:1.8;
    font-family:Consolas,monospace;
}

textarea:focus{
    border-color:#38bdf8;
}

/* RIGHT SIDE */

.output-section{
    width:50%;
    display:flex;
    flex-direction:column;
    background:#f8fafc;
}

.output-header{
    height:65px;
    background:white;
    border-bottom:1px solid #e5e7eb;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 25px;
}

.output-title{
    font-size:18px;
    font-weight:600;
    color:#111827;
}

.status{
    display:flex;
    align-items:center;
    gap:8px;
    color:#22c55e;
    font-size:14px;
}

.status-dot{
    width:10px;
    height:10px;
    background:#22c55e;
    border-radius:50%;
}

.output-body{
    flex:1;
    padding:15px;
    background:#f1f5f9;
}

iframe{
    width:100%;
    height:100%;
    border:none;
    background:white;
    border-radius:12px;
    box-shadow:
        0 10px 30px rgba(0,0,0,.08);
}

.footer{
    height:40px;
    background:#0b1220;
    color:#94a3b8;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:13px;
}

</style>
</head>
<body>

<div class="container">

    <!-- Editor -->

    <div class="editor-section">

        <div class="topbar">

            <div class="logo">
                PHP<span>Compiler</span>
            </div>

            <div class="controls">

                <button class="clear-btn" type="button">
                    Clear
                </button>

                <button class="run-btn" type="submit" form="compilerForm">
                    ▶ Run
                </button>

            </div>

        </div>

        <div class="editor-wrapper">

            <form
                id="compilerForm"
                action="{{ route('storecode') }}"
                method="POST"
                target="outputFrame"
                style="height:100%;"
            >
                @csrf

<textarea name="code">
<?php

echo "Hello World";

?>
</textarea>

            </form>

        </div>

    </div>

    <!-- Output -->

    <div class="output-section">

        <div class="output-header">

            <div class="output-title">
                Output Preview
            </div>

            <div class="status">
                <div class="status-dot"></div>
                Ready
            </div>

        </div>

        <div class="output-body">

            <iframe
                name="outputFrame">
            </iframe>

        </div>

        <div class="footer">
            PHP Web Compiler • Laravel Powered
        </div>

    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.52.2/min/vs/loader.min.js"></script>

<script>

require.config({
    paths: {
        vs: 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.52.2/min/vs'
    }
});

require(['vs/editor/editor.main'], function () {

    const textarea = document.querySelector('textarea[name="code"]');

    const editorContainer = document.createElement('div');
    editorContainer.id = 'editor';

    editorContainer.style.width = '100%';
    editorContainer.style.height = '100%';
    editorContainer.style.borderRadius = '12px';
    editorContainer.style.overflow = 'hidden';

    textarea.parentNode.insertBefore(editorContainer, textarea);
    textarea.style.display = 'none';

    const editor = monaco.editor.create(editorContainer, {
        value: textarea.value,
        language: 'php',
        theme: 'vs-dark',
        automaticLayout: true,
        fontSize: 15,
        minimap: {
            enabled: false
        },
        roundedSelection: true,
        scrollBeyondLastLine: false
    });

    document
        .getElementById('compilerForm')
        .addEventListener('submit', function(){

            textarea.value = editor.getValue();

        });

});

</script>
</body>
</html>