<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kunder</title>
    <link rel="stylesheet" type="text/css" href="../Styles.css" />
    <script src="../functions.js" defer></script>
</head>
<body>
    <h1>Roadmap</h1>
    <p>Ved at klikke ind på funktionerne, kan i vote omkring dem og tilknytte kommentarer.</p>
    <p>OBS! Der kan forekomme ændringer efter jeres voteringer.</p>
    <div id="overlay" onclick="off()">
        <div class="overlay-box">
            <p>teeeeest</p>
        </div>
    </div>
    <canvas id="canvass"></canvas>
    <div class="customer-box-container">
        <div class="customer-box">
            <h2>overskrift1</h2>
            <p>text1</p>
            <p class="overlay-link" onclick="on()">Læs mere</p>
            <div class="customer-publication">
                <p>Udgivelse</p>
            </div>
        </div>
        <div class="customer-box">
            <h2>overskrift2</h2>
            <p>text2</p>
            <p class="overlay-link" onclick="on()">Læs mere</p>
            <div class="customer-publication">
                <p>Udgivelse</p>
            </div>
        </div>
        <div class="customer-box">
            <h2>overskrift3</h2>
            <p>text3</p>
            <p class="overlay-link" onclick="on()">Læs mere</p>
            <div class="customer-publication">
                <p>Udgivelse</p>
            </div>
        </div>
    </div>
    <div class="customer-box-container">
        <div class="customer-box">
            <h2>overskrift6</h2>
            <p>text6</p>
            <p class="overlay-link" onclick="on()">Læs mere</p>
            <div class="customer-publication">
                <p>Udgivelse</p>
            </div>
        </div>
        <div class="customer-box">
            <h2>overskrift5</h2>
            <p>text5</p>
            <p class="overlay-link" onclick="on()">Læs mere</p>
            <div class="customer-publication">
                <p>Udgivelse</p>
            </div>
        </div>
        <div class="customer-box">
            <h2>overskrift4</h2>
            <p>text4</p>
            <p class="overlay-link" onclick="on()">Læs mere</p>
            <div class="customer-publication">
                <p>Udgivelse</p>
            </div>
        </div>
    </div>
    <div class="customer-box-container">
        <div class="customer-box">
            <h2>overskrift7</h2>
            <p>text7</p>
            <p class="overlay-link" onclick="on()">Læs mere</p>
            <div class="customer-publication">
                <p>Udgivelse</p>
            </div>
        </div>
        <div class="customer-box">
            <h2>overskrift8</h2>
            <p>text8</p>
            <p class="overlay-link" onclick="on()">Læs mere</p>
            <div class="customer-publication">
                <p>Udgivelse</p>
            </div>
        </div>
        <div class="customer-box">
            <h2>overskrift9</h2>
            <p>text9</p>
            <p class="overlay-link" onclick="on()">Læs mere</p>
            <div class="customer-publication">
                <p>Udgivelse</p>
            </div>
        </div>
    </div>
    <script>let c = document.getElementById("canvass");
let ctx = c.getContext("2d");
ctx.beginPath();
ctx.moveTo(20, 20);
ctx.bezierCurveTo(20, 100, 200, 100, 200, 20);
ctx.stroke();</script>
</body>
</html>