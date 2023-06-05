
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../Styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <button id="opretBTN">Opret ny feature</button>
    <button id="switchBTN" onclick="window.location.href='customer.php'">Se hvad kunden ser</button>
    <div class ="headerTitle">
        <h1>Top 3</h1>
    </div>

    <div id="myModal" class="modal">
      <div class="modal-content">
        <h2>Oprettelse af nye features</h2>
        <p>Herunder kan du oprette nye features</p>
        <form id="form" >
            <div class="modal-div">
              <div class="modalDivName">
                 <label for="navn">Navn:</label>
                  <input type="text" id="name" name="navn" >
                </div>
                <div>
                <div class="modalDivStatus">
                  <label for="taskStatus">Status:</label>
                    <select name="taskStatus" id="dropbtn" >
                      <option value="">Vælg</option>
                      <option value="0">Ventende</option>
                      <option value="1">Igangværende</option>
                    </select>
                </div>
                </div>
                <div class="modalDivDesc">
                  <label for="beskrivelse">Beskrivelse:</label>
                  <textarea name="beskrivelse" id="description" cols="30" rows="5" ></textarea>
                </div>
              <div class="modalDivDate">
                <label for="dato">Dato:</label>
                <input type="date" id="date" name="dato" >
              </div>
            </div>
            <div class="divBTNS">
              <button class="cancelBTN">Annuller</button>
              <input type="submit" class="saveBTN">
            </div>
        </form>
      </div>
    </div>

    <div class="table">
      <table class="content-table-top3">
        <thead>
          <tr>
            <th>Navn</th>
            <th>Bedømmelse</th>
            <th>Status</th>
            <th>Kommentarer</th>
            <th>Kvartal</th>
            <th>Årstal</th>
            <th>Rediger</th>
          </tr>
        </thead>
        <tbody id="dataTop3">
        </tbody>
      </table>
    </div>

        
        <div class ="headerTitle">
          <h1>Kommende funktioner</h1>
        </div>
      <div class="table">
        <table class="content-table">
          <thead>
            <tr>
              <th>Navn</th>
              <th>Bedømmelse</th>
              <th>Status</th>
              <th>Kommentarer</th>
              <th>Kvartal</th>
              <th>Årstal</th>
              <th>Rediger</th>
            </tr>
          </thead>
          <tbody id="mainTableRows">
          </tbody>
        </table>
      </div>
</body>
</html>

<script text="javascript">

  /* opret ny opgave */
  let modal = document.getElementById("myModal");
  let btn = document.getElementById("opretBTN");
  let cancel = document.getElementsByClassName("cancelBTN")[0];
  let save = document.getElementsByClassName("saveBTN")[0];

  btn.onclick = function() {
    modal.style.display = "block";
  };

  cancel.onclick = function() {
    modal.style.display = "none";
  };

  save.onclick = function() {
    let a = document.forms["form"]["name"].value;
    let b = document.forms["form"]["taskStatus"].value;
    let c = document.forms["form"]["beskrivelse"].value;
    let d = document.forms["form"]["dato"].value;
    
    if( a == ""){
      alert("Navn skal være udfyldt");
      return false;
    } else if(b == "") {
      alert("Status skal være udfyldt");
      return false;
    } else if(c == "") {
      alert("Beskrivelse skal være udfyldt");
      return false;
    } else if(d == "") {
      alert("dato skal være udfyldt");
      return false;
    } else{
    modal.style.display = "none";
    }
  };

  window.onclick = function(event) {
    if (event.target == modal) {  
      modal.style.display = "none";
    }
  };


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

      /* looper gennem dataen */
      for (let i = 0; i < dataTasks.length; i++)
      {
        /* Henter dataen fra tabellerne og sætter dem ind i variabler */
        let name = dataTasks[i].navn;
        let eval = dataTasks[i].bedømmelse_id;
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
          html += '<td ><h3>Navn</h3><input type="text" id="name" name="navn"></td>';
          html += '<td ><h3>Status</h3><input type="text" id="name" name="navn"></td>';
          html += '<td ><h3>Beskrivelse</h3><input type="text" id="name" name="navn"></td>';
          html += '<td ><h3>Årstal</h3><input type="text" id="name" name="navn"></td>';
          html += '<td ><button class="dropdownDivCloseBtn">Gem</button></td>';
        html += "</tr>";
      };

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
        };

        function closeDropdownBox() {
          dropdownEditBox[i].style.display = "none";
        };
      };     
    };
  };



 


  /* ajax POST kald(VIRKER IKKE) */
  let form = document.querySelector('#form');

  form.addEventListener('submit',(e) => {
    e.preventDefault();  

    let formData = new FormData(form);

    let res = Object.fromEntries(formData);
    let payload = JSON.stringify(res);
    console.log(res);
    console.log(payload);

    for (item of formData) {
      console.log(item[0],item[1]);
    }

    fetch('http://localhost/roadmap/PHP/dbCon/Api.php?action=addtasks', {
      method:'POST',
      body: payload,
      headers: {
        'Accept': 'application/json',
        'content-Type': 'application/json'
      }
    })
    .then((res) => res.json() )
    
    .then((res) => {
      if (res.status === 200) {
        console.log("Post successfully created!")
      }
    })
      
    .catch((error) => {
      console.log(error)
    })

  });  
</script>