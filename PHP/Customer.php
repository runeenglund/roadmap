<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kunder</title>
    <link rel="stylesheet" type="text/css" href="../Styles.css" />
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto Condensed' rel='stylesheet'>
</head>
<body>
    <div class="top-customer">
        <h1>Roadmap</h1>
        <p>Ved at klikke ind på funktionerne, kan i vote omkring dem og tilknytte kommentarer.</p>
        <p>OBS! Der kan forekomme ændringer efter jeres voteringer.</p>
        <button id="workerBTN" onclick="window.location.href='index.php'">Medarbejder</button>
    </div>
    <div id="overlay">
        <div class="overlay-box">
            <span class="close" onclick="hideOverlay()">&times;</span>
            <div id="overlay-content"></div>
            <h2>Kommentar:</h2>
            <div class="comment">
                <textarea name="kommentar" id="kommentar" cols="100" rows="10"></textarea>
                <button type="submit" id="submitBTN">Send</button>
            </div>
        </div>
    </div>

    <div id="customer-data"></div>
    <svg id="svg-line-box" viewBox="100" preserveAspectRatio="xMidYMid meet">
        <path d="M 100 140 h1200 v0" stroke="#F06F63" stroke-width="5" fill="none" /> 
        <path d="M 1400 150 h0 v300" stroke="#F06F63" stroke-width="5" fill="none" /> 
        <path d="M 100 420 h1200 v0" stroke="#F06F63" stroke-width="5" fill="none" /> 
        Din browser understøtter ikke inline SVG.
    </svg> 


    <script>
        /* ajax GET kald */
        let ajax = new XMLHttpRequest();
        ajax.open("GET", "http://localhost/roadmap/PHP/dbCon/Api.php?action=jointasks", true);
        ajax.send();

        /* modtager respons fra Api.php */
        ajax.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            let data = JSON.parse(this.responseText);
            /* console.log(data); */

            /* html værdier for <tbody> */
            let html = "";
            
            /* Hack til at tilgå objektet rigtigt */
            let dataTasks = data.tasks;

            console.log(dataTasks);

            /* Sorterer datoerne kronologisk */
            function byDate(a, b) {
                return new Date(a.dato).valueOf() - new Date(b.dato).valueOf(); 
            } 

            console.log(dataTasks.sort(byDate));

            /* looper gennem dataen */
            for (let i = 0; i < dataTasks.sort(byDate).length; i++)
            {
                /* Henter dataen fra tabellerne og sætter dem ind i variabler */
                let name = dataTasks[i].navn;
                let eval = dataTasks[i].bedømmelse;
                let status = dataTasks[i].taskStatus;
                let beskrivelse = dataTasks[i].beskrivelse;
                let date = dataTasks[i].dato;

                /* Ternary operator for status, fungerer som en if-statement. Hvis status er 1 printer den igangværende, hvis status er andet end 1 printer den ventende */
                let statusCurrentWaiting = (status == 1) ? "Igangværende":"Ventende";

                /* Dato split. Splitter datoen ind i år, måneder, dage */
                let dateSplit = date.split("-");
                let year = dateSplit[0];
                let month = dateSplit[1];
                let day = dateSplit[2];

                /* sorterer måneder ind i kvartaler med en if-statement */
                let findQuarter = (monthQuarter = 1) => {
                if (monthQuarter <= 3) {
                    return 1
                } else if (monthQuarter <= 6) {
                    return 2
                } else if (monthQuarter <= 9) {
                    return 3
                } else if (monthQuarter <= 12) {
                    return 4
                }
                };
                /* console.log(findQuarter(month)); */
                
                /* appender til html */
                html += '<div class="customer-box-container">';
                    html += '<div class="customer-box">';
                        html += "<h2>" + name + "</h2>";
                        html += '<p class="status-funktion">Status: ' + statusCurrentWaiting + "</p>";
                        html += '<div class="overlay-link" onclick="showOverlay(\'' + "<h2>" + name + "</h2>" + "<p>Status: " + statusCurrentWaiting + "</p>" + beskrivelse +  "')\">Læs mere</div>";
                        html += '<div class="customer-publication">';
                            html += '<h4 class="udgivelse">Kvartal ' + findQuarter(month); + "</h4>";
                            html += '<h4 class="udgivelse">År ' + year + "</h4>";
                        html += '</div>';
                    html += '</div>';
                html += '</div>';
            }

            /* inputter data */
            document.getElementById("customer-data").innerHTML += html;
            }
        }

        function showOverlay(beskrivelse) {
        let overlay = document.getElementById("overlay");
        let overlayContent = document.getElementById("overlay-content");

        overlayContent.innerHTML = beskrivelse;
        overlay.style.display = "block";
        }

        function hideOverlay() {
        let overlay = document.getElementById("overlay");
        overlay.style.display = "none";
        }

        /*
        function specificData(id) {
        fetch(`http://localhost/roadmap/PHP/dbCon/Api.php?action=tasks/${id}`)
            .then(response => response.json())
            .then(data => {
            console.log(data);
            })
            .catch(error => {
            console.error('Error:', error);
            });
        }*/

    </script>
</body>
</html>