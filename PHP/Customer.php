<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kunder</title>
    <link rel="stylesheet" type="text/css" href="../Styles.css" />
</head>
<body>
    <div class="topCustomer">
        <h1>Roadmap</h1>
        <p>Ved at klikke ind på funktionerne, kan i vote omkring dem og tilknytte kommentarer.</p>
        <p>OBS! Der kan forekomme ændringer efter jeres voteringer.</p>
        <button id="workerBTN" onclick="window.location.href='index.php'">Medarbejder</button>
    </div>
    <div id="overlay" onclick="off()">
        <div class="overlay-box">
            <p>teeeeest</p>
        </div>
    </div>
    
    <svg id="svg-line-box" viewBox="100" preserveAspectRatio="xMidYMid meet">
        <path d="M 225 250 q 350 -150 700 0" stroke="#F06F63" stroke-width="5" fill="none" /> 
        <path d="M 750 150 q 350 150 700 0" stroke="#F06F63" stroke-width="5" fill="none" vector-effect="non-scaling-stroke"/> 
        <path d="M 1550 525 q 150 -200 0 -400" stroke="#F06F63" stroke-width="5" fill="none" vector-effect="non-scaling-stroke"/> 
        <path d="M 750 550 q 350 -150 700 0" stroke="#F06F63" stroke-width="5" fill="none" vector-effect="non-scaling-stroke"/>
        <path d="M 225 400 q 350 150 700 0" stroke="#F06F63" stroke-width="5" fill="none" vector-effect="non-scaling-stroke"/>
        <path d="M 125 825 q -200 -150 0 -400" stroke="#F06F63" stroke-width="5" fill="none" vector-effect="non-scaling-stroke"/> 
        <path d="M 225 850 q 350 -150 700 0" stroke="#F06F63" stroke-width="5" fill="none" vector-effect="non-scaling-stroke"/>
        <path d="M 750 700 q 350 150 700 0" stroke="#F06F63" stroke-width="5" fill="none" vector-effect="non-scaling-stroke"/>
        Din browser understøtter ikke inline SVG.
    </svg> 

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
    <script>
        //overlay on/off
        function on() {
        document.getElementById("overlay").style.display = "block";
        }

        function off() {
        document.getElementById("overlay").style.display = "none";
        }
    </script>
</body>
</html>