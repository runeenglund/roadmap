
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medarbejder</title>
    <link rel="stylesheet" type="text/css" href="../Styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto Condensed' rel='stylesheet'>
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
                <div class="modalDivStatus">
                  <label for="taskStatus">Status:</label>
                    <select name="taskStatus" id="dropbtn" >
                      <option value="">Vælg</option>
                      <option value="0">Ventende</option>
                      <option value="1">Igangværende</option>
                    </select>
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
      alert("Ny feature oprettet");
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
      /* console.log(this.responseText); */
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

      /* console.log(dataTasks.sort(byDate)); */

      /* Tæller hvor mange bedømmelser hver task har fået gennem bedømmelses_id, som definerer hvilken task bedømmelserne hører til, og selve bedømmelsen, som skal er en bolean */
      let countOccurrencesOfEvaluations = (dataTasks) => {
          let map = {};
          for ( var i = 0; i < dataTasks.length; i++ ) {
              map[dataTasks[i].bedømmelse_id] = ~~map[dataTasks[i].bedømmelse] + 1;
              console.log(JSON.stringify(dataTasks[i].bedømmelse_id + ":" + dataTasks[i].bedømmelse));
          }
          return map;
      }

      let result = countOccurrencesOfEvaluations(dataTasks);
      console.log(JSON.stringify(result));
      console.log(result);

      let { "1": bedømmelse_id, ...rest } = result;
      let obj = { "0": 1, ...rest }

      console.log(obj);

      /* looper gennem dataen */
      for (let i = 0; i < dataTasks.sort(byDate).length; i++)
      {
        /* Henter dataen fra tabellerne og sætter dem ind i variabler */
        let name = dataTasks[i].navn;
        let eval = dataTasks[i].bedømmelse;
        let eval_id = dataTasks[i].bedømmelse_id;
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
              html += '<td ><p>Navn</p><input type="text" id="name" name="name1"></td>';
              html += '<td ><p>Status</p><input type="text" id="status" name="status1"></td>';
              html += '<td ><p>Beskrivelse</p><input type="text" id="description" name="description1"></td>';
              html += '<td ><p>Dato</p><input type="text" id="date" name="date1"></td>';
              html += '<td ><button class="dropdownDivCancelBtn">Annuller</button><button class="dropdownDivCloseBtn">Gem</button></td>';
        html += "</tr>";
      };

      /* erstater <tbody> af <table> */
      document.getElementById("dataTop3").innerHTML += html;
      document.getElementById("mainTableRows").innerHTML += html;

      /* Laver dropdown rediger bokse til hver af taskene */
      let dropdownEditArrow = document.querySelectorAll(".dropdownEditArrow");
      let dropdownEditBox = document.getElementsByClassName("dropdownEditDiv");
      let dropdownDivCloseBtn = document.getElementsByClassName("dropdownDivCloseBtn");
      let dropdownDivCancelBtn = document.getElementsByClassName("dropdownDivCancelBtn");
      
      for (let i = 0; i < dropdownEditArrow.length; i++) {
        dropdownEditArrow[i].addEventListener("click", openDropdownBox);
        dropdownDivCloseBtn[i].addEventListener("click", closeDropdownBox);
        dropdownDivCancelBtn[i].addEventListener("click", cancelCloseDropdownBox);

        function openDropdownBox() {
          dropdownEditBox[i].style.display = "block";
        };

        function closeDropdownBox() {
          if( document.getElementById('name').value == ""){
            alert("Navn skal være udfyldt");
            return false;
          } else if(document.getElementById('status').value == "") {
            alert("Status skal være udfyldt");
            return false;
          } else if(document.getElementById('description').value == "") {
            alert("Beskrivelse skal være udfyldt");
            return false;
          } else if(document.getElementById('date').value == "") {
            alert("dato skal være udfyldt");
            return false;
          } else{
            alert("Ny feature oprettet");
            dropdownEditBox[i].style.display = "none";
          }
        };

        function cancelCloseDropdownBox() {
            dropdownEditBox[i].style.display = "none";
        };

      }; 
    };
  };




  /* ajax POST kald */
  let form = document.querySelector('#form');

  /* sætter en eventlistener på typen 'submit' i formen */
  form.addEventListener('submit',(e) => {
    e.preventDefault();  

    /* Laver en variabel, hvor dataen fra formen om bliver sat ind som et js objeckt */
    let formData = new FormData(form);

    /* Laver key/value pairs'ne om til et js objekt */
    let res = Object.fromEntries(formData);

    /* Laver js objektet om til et JSON objekt */
    let payload = JSON.stringify(res);
   /*  console.log(res);
    console.log(payload); */

    /* Tjekker dataen fra de forskellige inputs i formen */
    for (item of formData) {
      console.log(item[0],item[1]);
    }

    /* Sender JSON objektet til api url'en, sætter metoden som en post metode og sender variablen 'payload' med som 'body'. */
    fetch('http://localhost/roadmap/PHP/dbCon/Api.php?action=addtasks', {
      method:'POST',
      body: payload,
      headers: {
        'Accept': 'application/json',
        'content-Type': 'application/json'
      }
    })
    
    /* Tester om posten er succesfuld */
    .then((res) => {
      if (res.status === 200) {
        console.log("Post successfully created!")
      }
    })
      
    /* Fanger fejl hvis der er nogen */
    .catch((error) => {
      console.log(error)
    })

  });  
</script>