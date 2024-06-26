<?php
require 'php/session.php';

?>
<!doctype html>
<html>
<head>
    <title>Painel Interposto</title>
    <link href="css/normalize.css" type="text/css" rel="stylesheet">
    <link href="css/font.css" type="text/css" rel="stylesheet">
    <link href="css/main.css" type="text/css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>  
    <script src="/js/main.js"></script>
</head>
    
<body>
    <header>
        <button class="menu-button">
            <svg aria-hidden="true" height="16" viewBox="0 0 16 16" width="16">
                <path d="M1 2.75A.75.75 0 0 1 1.75 2h12.5a.75.75 0 0 1 0 1.5H1.75A.75.75 0 0 1 1 2.75Zm0 5A.75.75 0 0 1 1.75 7h12.5a.75.75 0 0 1 0 1.5H1.75A.75.75 0 0 1 1 7.75ZM1.75 12h12.5a.75.75 0 0 1 0 1.5H1.75a.75.75 0 0 1 0-1.5Z"></path>
            </svg>
        </button>
        <object class="logo" type="image/svg+xml" data="images/logo.svg" aria-label="Interposto">Interposto</object>
        <span class="heading">Painel</span>
    </header>
    <aside>
    
        <div class="header">
            <h2>Meus Projetos</h2>
            <button class="new-button">
                <svg class="new-icon" aria-hidden="true" height="16" viewBox="0 0 16 16" width="16">
                     <path d="M2 2.5A2.5 2.5 0 0 1 4.5 0h8.75a.75.75 0 0 1 .75.75v12.5a.75.75 0 0 1-.75.75h-2.5a.75.75 0 0 1 0-1.5h1.75v-2h-8a1 1 0 0 0-.714 1.7.75.75 0 1 1-1.072 1.05A2.495 2.495 0 0 1 2 11.5Zm10.5-1h-8a1 1 0 0 0-1 1v6.708A2.486 2.486 0 0 1 4.5 9h8ZM5 12.25a.25.25 0 0 1 .25-.25h3.5a.25.25 0 0 1 .25.25v3.25a.25.25 0 0 1-.4.2l-1.45-1.087a.249.249 0 0 0-.3 0L5.4 15.7a.25.25 0 0 1-.4-.2Z"></path>
                </svg>
                <span>
                    Novo
                </span>
                
            </button>
        </div>
        <input type="text" id="project-search" class="project-search" placeholder="Procure um projeto..."/>
        <ul class="project-list" id="sidebar-projects">
            <li class="loading-element" id="loading">
                </div>
                <span class="project-name">
                    <a href=""> </a>
                </span>
            </li>
        </ul>
        <div class="link-all" style="display: none;">
            <a href="#">Mostrar mais</a>
        </div>
        
        
        
    </aside>
    <div class="main-content home">
        <div class="feed">
            
            <h1 class="sr-only">Painel</h1>
            <h2>Meu Feed</h2>
       
            <div class="card lite update">
                <div class="heading">
                    <img class="avatar" width="40px" height="40px" class="avatar" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAA1BMVEWhoaFpDRRbAAAASElEQVR4nO3BgQAAAADDoPlTX+AIVQEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADwDcaiAAFXD1ujAAAAAElFTkSuQmCC"/>
                    <div class="details">
                        <span class="update-summary"><span class="author-name">Francisco Stelzer</span> criou um novo projeto.</span>
                        <span class="time-signature">5 dias atrás</span>
                    </div>
                </div>
                <div class="card-content">
                    <div class="project">
                        <div class="project-author">
                            <img width="16px" height="16px" src="https://avatars.githubusercontent.com/u/64212308?s=16&v=4"/>
                            <img width="16px" height="16px" class="avatar" src="https://avatars.githubusercontent.com/u/64212308?s=16&v=4"/>
                            <span class="author-info-popup">
                                <ul>
                                    <li>Francisco Stelzer</li>
                                    <li> Julia Salzano</li>
                                </ul> 
                            </span>
                        </div>
                        <span class="project-name">
                            <a href="#">Construção sustentável</a>
                        </span>
                    </div>
                </div>
            </div>
    </div>
    <div class="pinboard">
        <div class="card lite">
            <h2>Últimos anúncios</h2>
            <ul class="pins">
                <li class="pin">
                    <div  class="dot">
                        <svg height="16" viewBox="0 0 16 16" width="16">
                            <path d="M8 4a4 4 0 1 1 0 8 4 4 0 0 1 0-8Z"></path>
                        </svg>
                    </div>
                    <div class="pin-content">
                        <span class="time-signature">5 dias atrás</span>
                        <a class="pin-title">Erros no Modo Escuro foram corrigidos no site...</a>
                    </div>
                </li>
                <li class="pin">
                    <div  class="dot">
                        <svg height="16" viewBox="0 0 16 16" width="16">
                            <path d="M8 4a4 4 0 1 1 0 8 4 4 0 0 1 0-8Z"></path>
                        </svg>
                    </div>
                    <div class="pin-content">
                        <span class="time-signature">8 dias atrás</span>
                        <a class="pin-title">Mudanças na política de AI...</a>
                    </div>
                </li>
            </ul>
            <div class="link-all">
                <a href="#">Ver todos os anúncios →</a>
            </div>
        </div>
    </div>
</body>
</html>