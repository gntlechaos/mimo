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
    <script src="/js/edit.js"></script>
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
            <h2>Banco de Imagens</h2>
            <div class="image-bank" id="image-bank">
                <button class="add-image">
                    <svg width="16" height="16" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.75 0C5.94891 0 6.13968 0.0790175 6.28033 0.21967C6.42098 0.360322 6.5 0.551088 6.5 0.75V5H10.75C10.9489 5 11.1397 5.07902 11.2803 5.21967C11.421 5.36032 11.5 5.55109 11.5 5.75C11.5 5.94891 11.421 6.13968 11.2803 6.28033C11.1397 6.42098 10.9489 6.5 10.75 6.5H6.5V10.75C6.5 10.9489 6.42098 11.1397 6.28033 11.2803C6.13968 11.421 5.94891 11.5 5.75 11.5C5.55109 11.5 5.36032 11.421 5.21967 11.2803C5.07902 11.1397 5 10.9489 5 10.75V6.5H0.75C0.551088 6.5 0.360322 6.42098 0.21967 6.28033C0.0790175 6.13968 0 5.94891 0 5.75C0 5.55109 0.0790175 5.36032 0.21967 5.21967C0.360322 5.07902 0.551088 5 0.75 5H5V0.75C5 0.551088 5.07902 0.360322 5.21967 0.21967C5.36032 0.0790175 5.55109 0 5.75 0Z" fill="#848D97"/>
                    </svg>
                </button>
                <img img-id="1" src="https://midia.interposto.com/artigos/3_2n.png" draggable="true" />
                <img img-id="2" src="https://midia.interposto.com/artigos/2_3.png" draggable="true"/>
                <img img-id="3" src="https://midia.interposto.com/artigos/2_4.png" draggable="true"/>

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
</body>
</html>