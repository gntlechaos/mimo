<!doctype html>
<html lang="pt-br">
<head>
    <title>Editar Artigo</title>
    <link href="css/normalize.css" type="text/css" rel="stylesheet">
    <link href="css/font.css" type="text/css" rel="stylesheet">
    <link href="css/main.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.bubble.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>  
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <!-- <script src="/js/main.js"></script> -->
</head>
    
<body class="lite">
    <header>
        <button class="menu-button">
            <svg aria-hidden="true" height="16" viewBox="0 0 16 16" width="16">
                <path d="M1 2.75A.75.75 0 0 1 1.75 2h12.5a.75.75 0 0 1 0 1.5H1.75A.75.75 0 0 1 1 2.75Zm0 5A.75.75 0 0 1 1.75 7h12.5a.75.75 0 0 1 0 1.5H1.75A.75.75 0 0 1 1 7.75ZM1.75 12h12.5a.75.75 0 0 1 0 1.5H1.75a.75.75 0 0 1 0-1.5Z"></path>
            </svg>
        </button>
        <object class="logo" type="image/svg+xml" data="images/logo.svg" aria-label="Interposto">Interposto</object>
        <span class="heading">Editar Artigo</span>
    </header>
    <div class="main-content editing">
        <div class="edit-feed">
            
            <h1 class="sr-only">Editar Artigo</h1>
       
            <div class="card lite edit">
                <div class="heading">
                    <span class="title">Cabeçalho</span>
                  </div>
                <div class="card-content">
                    <div class="input-field">
                        <span class="label">Título</span>
                        <input class="title" type="text" placeholder="Título dessa publicação"/>
                    </div>
                    <div class="input-field">
                        <span class="label">Subtítulo</span>
                        <input class="subtitle" type="text" placeholder="Subtítulo dessa publicação"/>
                    </div>
                    
                </div>
            </div>

            <div class="card lite edit edit-text">
                <div class="heading">
                  <span class="title">Corpo do Texto</span>
                  <span class="word-count" id="word-count" plural="true">0</span>
                </div>
                <div class="card-content" id="main-text-editable">
                    
                </div>
            </div>
            
            
    </div>
    <div class="pinboard">
        <div class="card lite metadata">
            <h2>Metadados da Publicação</h2>
            <div class="card-content">
                <div class="section">
                    <span class="title">Autores</span>
                </div>
                <div class="section">
                    <span class="title">Local de publicação</span>
                </div>
                <div class="section">
                    <span class="title">Data de publicação</span>
                </div>
                <div class="section">
                    <span class="title">Tags</span>
                </div>        
            </div>    
        </div>
        <div class="card lite">
            <h2>Linha do tempo</h2>
            <ul class="pins">
                <li class="pin">
                    <div  class="dot">
                        <svg height="16" viewBox="0 0 16 16" width="16">
                            <path d="M8 4a4 4 0 1 1 0 8 4 4 0 0 1 0-8Z"></path>
                        </svg>
                    </div>
                    <div class="pin-content">
                        <span class="time-signature">Criação do projeto</span>
                        <a class="pin-title">24 de abril de 2024</a>
                    </div>
                </li>
                <li class="pin">
                    <div  class="dot">
                        <svg height="16" viewBox="0 0 16 16" width="16">
                            <path d="M8 4a4 4 0 1 1 0 8 4 4 0 0 1 0-8Z"></path>
                        </svg>
                    </div>
                    <div class="pin-content">
                        <span class="time-signature">Primera versão</span>
                        <a class="pin-title">28 de abril de 2024</a>
                    </div>
                </li>
                <li class="pin">
                    <div  class="dot">
                        <svg height="16" viewBox="0 0 16 16" width="16">
                            <path d="M8 4a4 4 0 1 1 0 8 4 4 0 0 1 0-8Z"></path>
                        </svg>
                    </div>
                    <div class="pin-content">
                        <span class="time-signature">Revisão</span>
                        <a class="pin-title">30 de abril de 2024</a>
                    </div>
                </li>
                <li class="pin">
                    <div  class="dot">
                        <svg height="16" viewBox="0 0 16 16" width="16">
                            <path d="M8 4a4 4 0 1 1 0 8 4 4 0 0 1 0-8Z"></path>
                        </svg>
                    </div>
                    <div class="pin-content">
                        <span class="time-signature">Versão final</span>
                        <a class="pin-title">1 de maio de 2024</a>
                    </div>
                </li>
            </ul>
            <div class="link-all">
                <a href="#">Ver todas as versões →</a>
            </div>
        </div>
    </div>
    <script>
        function Counter(quill, options) {
            const container = document.querySelector('#word-count');
            quill.on(Quill.events.TEXT_CHANGE, () => {
                const text = quill.getText();
                count = text.split(/\s+/).length - 1;
                if(count == 1 && text.charCodeAt(0) == 10){
                    count = 0;
                }
                container.innerText = count;
                container.setAttribute("plural",count !== 1);

            });
            }

        Quill.register('modules/counter', Counter);

        const toolbarOptions = ['bold', 'italic', 'underline', 'strike', 'blockquote', 'clean' ,  { 'script': 'sub'}, { 'script': 'super' }];

        const quill = new Quill('#main-text-editable', {
            placeholder: 'Comece a escrever aqui...',
            theme: 'bubble',
            modules: {
              toolbar: toolbarOptions,
              counter: true
            }
        });
     </script>
</body>
</html>