
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
        <span class="close">Close</span>
        <form id="form">
          <div class="modal-div1">
            <div class="modal-div2">
              <div class="modalDivName">
                <h2>Navn:</h2>
                  <input type="text" id="name" name="navn">
                </div>
                <div class="modalDivStatus">
                  <h2>Status:</h2>
                  <input type="text" id="status" name="taskStatus">
                </div>
                <div class="modalDivDesc">
                  <h2>Beskrivelse:</h2>
                  <textarea name="beskrivelse" id="description" cols="30" rows="5"></textarea>
                </div>
              <div class="modalDivDate">
                <h2>Dato:</h2>
                <input type="text" id="year" name="årstal">
              </div>
            </div>
            <button type="submit" class="saveBTN">Gem</button>
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

  /* opret nu opgave */

  let modal = document.getElementById("myModal");
  let btn = document.getElementById("opretBTN");
  let span = document.getElementsByClassName("close")[0];

  btn.onclick = function() {
  modal.style.display = "block";
  }

  span.onclick = function() {
    modal.style.display = "none";
  }

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
      
      let dataTasks = data.tasks;

      console.log(dataTasks);

      /* looper gennem dataen */
      for (let i = 0; i < dataTasks.length; i++)
      {

        let name = dataTasks[i].navn;
        let eval = dataTasks[i].bedømmelse;
        let status = dataTasks[i].taskStatus;
        let date = dataTasks[i].dato;
        let comment = dataTasks[i].kommentar;

        let statusCurrentWaiting = (status == 1) ? "Igangværende":"Ventende";

        let dateSplit = date.split("-");
        let year = dateSplit[0];
        let month = dateSplit[1];
        let day = dateSplit[2];

        let findQuarter = (month1 = 1) => {
          if (month1 <= 3) {
              return 1
          } else if (month1 <= 6) {
              return 2
          } else if (month1 <= 9) {
              return 3
          } else if (month1 <= 12) {
              return 4
          }
        }
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
        html += '<div class="dropdownEditDiv"></div>';
        
  
        

        document.onload = function(){ 
          dropdownEditArrow.onclick = function(){

            console.log("det fungerer");

          }
        };




      }

      /* erstater <tbody> af <table> */
      document.getElementById("dataTop3").innerHTML += html;
      document.getElementById("mainTableRows").innerHTML += html;

        function hello() {
          alert('Hello');
        }


        let dropdownEditArrow = document.querySelectorAll(".dropdownEditArrow");

        for (let i = 0; i < dropdownEditArrow.length; i++) {
          dropdownEditArrow[i].addEventListener("click", hello);
        }

      
    }
  }



 


  /* ajax POST kald */
  let form = document.querySelector('#form');

  form.addEventListener('submit',(e) => {
    e.preventDefault();  

    let formData = new FormData(form);

    let res = Object.fromEntries(formData);
    let payload = JSON.stringify(form);
    /* console.log(res); */
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