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
            <table>
                <tr>
                    <th>Navn</th>
                    <th>Status</th>
                    <th>Beskrivelse</th>
                    <th>Dato</th>
                </tr>
                <?php
                while($rows=$result->fetch_assoc())
                {
                ?>
                <tr>
                    <!-- FETCHING DATA FROM EACH
                        ROW OF EVERY COLUMN -->
                    <td><?php echo $rows['navn'];?></td>
                    <td><?php echo $rows['taskStatus'];?></td>
                    <td><?php echo $rows['beskrivelse'];?></td>
                    <td><?php echo $rows['dato'];?></td>
                </tr>
                <?php
                }
                ?>
            </table>
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

        /* ajax GET kald */
        let ajax = new XMLHttpRequest();
        ajax.open("GET", "http://localhost/roadmap/PHP/dbCon/Api.php?action=show", true);
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

            /* looper gennem dataen */
            for (let i = 0; i < dataTasks.length; i++)
            {

                /* Henter dataen fra tabellerne og sætter dem ind i variabler */
                let name = dataTasks[i].navn;
                let eval = dataTasks[i].bedømmelse;
                let status = dataTasks[i].taskStatus;
                let date = dataTasks[i].dato;
                let comment = dataTasks[i].kommentar;

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
                html += "<tr>";
                html += "<td>" + name + "</td>";
                html += "<td>" + eval + "</td>";
                html += "<td>" + statusCurrentWaiting + "</td>";
                html += '<td><i class="fa fa-comments" aria-hidden="true" style="font-size:20px"></i>' + comment + '</td>';
                html += "<td>" + findQuarter(month); + "</td>";
                html += "<td>" + year + "</td>";
                html += '<td><span class="dropdownEditArrow"><i class="fa fa-angle-down" style="font-size:36px"></i></span></td>';
                html += "</tr>";
                html += '<tr class="dropdownEditDiv">';
                html += '<td ><input type="text" id="name" name="navn"></td>';
                html += '<td ><h3>Navn</h3></td>';
                html += '<td ><h3>Navn</h3></td>';
                html += '<td ><h3>Navn</h3></td>';
                html += '<td ><h3>Navn</h3></td>';
                html += '<td ><h3>Navn</h3></td>';
                html += '<td ><button class="dropdownDivCloseBtn">luk</button></td>';
                html += "</tr>";
                
            }

            /* erstater <tbody> af <table> */
            document.getElementById("dataTop3").innerHTML += html;
            document.getElementById("mainTableRows").innerHTML += html;

            /* Laver dropdown rediger bokse til hver af taskene */
            let dropdownEditArrow = document.querySelectorAll(".dropdownEditArrow");
            let dropdownEditBox = document.getElementsByClassName("dropdownEditDiv");
            let dropdownDivCloseBtn = document.getElementsByClassName("dropdownDivCloseBtn");
            
            for (let i = 0; i < dropdownEditArrow.length; i++) {
                dropdownEditArrow[i].addEventListener("click", openDropdownBox);
                dropdownDivCloseBtn[i].addEventListener("click", closeDropdownBox);

                function openDropdownBox() {
                dropdownEditBox[i].style.display = "block";
                dropdownEditBox[i].style.display = "flex";
                };

                function closeDropdownBox() {
                dropdownEditBox[i].style.display = "none";
                };
            };     
            }
        }
    </script>
</body>
</html>