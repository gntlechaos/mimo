<!doctype html>
<html>
<head>
    <title>Portal dos Autores</title>
    <link href="css/normalize.css" type="text/css" rel="stylesheet">
    <link href="css/font.css" type="text/css" rel="stylesheet">
    <link href="css/main.css" type="text/css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.9.4/p5.min.js"></script>
    <script src="js/login.js"></script>
</head> 
<body>
    <div class="main-content login" id="main">
        <div class="card lite">
           <h2>Portal dos Autores</h2>
           <h3>Insira seus dados de acesso para continuar.</h3>
            <form id="login-form">
                <label for="email">Endereço de E-mail</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
                <span class="message" id="message"></span>
                <input type="submit" value="Login">
            </form>
           
        </div>
    </div>
    <script>
    let angle = 0;

function setup() {
    let canvas = createCanvas(windowWidth, windowHeight, WEBGL);

    canvas.parent('main');
}

function draw() {
    clear();
   
    rotateY(angle);
    translate(-windowWidth/5,0,0);
    noFill(); 
    stroke(230,237,243); 
    strokeWeight(0.5);
    sphere(200, 24, 24); // The last two arguments specify the detail of the sphere (i.e., the number of latitude and longitude strips).
    angle += 0.005;
}

function windowResized() {
    resizeCanvas(windowWidth, windowHeight);
  }

</script>
</body>
</html>