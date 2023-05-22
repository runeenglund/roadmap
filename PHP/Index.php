
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../Styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../functions.js" defer></script>
</head>
<body>
    <button id="opretBTN">Opret ny feature</button>
    
    <div class ="headerTitle">
        <h1>Top 3</h1>
    </div>

    <div id="myModal" class="modal">
      <div class="modal-content">
        <span class="close">Close</span>
        <div class="modal-div1">
          <div class="modal-div2">
            <div class="modalDivName">
              <h1>Navn</h1>
              <input type="text">
            </div>
            <div class="modalDivStatus">
              <h1>Status</h1>
              <input type="text">
            </div>
           <button class="saveBTN">Gem</button>
          </div>
        </div>
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
            <th>Rediger</th>
          </tr>
        </thead>
        <tbody id="dataTop3">
        </tbody>
      </table>
    </div>

        
        <div class ="headerTitle">
          <h1>Top 3</h1>
        </div>
      <div class="table">
        <table class="content-table">
          <thead>
            <tr>
              <th>Navn</th>
              <th>Bedømmelse</th>
              <th>Status</th>
              <th>Kommentarer</th>
              <th>Rediger</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Formular</td>
              <td>2</td>
              <td>Igangværende</td>
              <td>1 kommentar</td>
              <td><i class="fa fa-angle-down" style="font-size:36px"></i></td>
            </tr>
            <tr>
              <td>Dashboard</td>
              <td>2</td>
              <td>ventende</td>
              <td>1 kommentar</td>
              <td><i class="fa fa-angle-down" style="font-size:36px"></i></td>
            </tr>
            <tr>
              <td>Ændring i menubar</td>
              <td>2</td>
              <td>Igangvære</td>
              <td>1 kommentar</td>
              <td><i class="fa fa-angle-down" style="font-size:36px"></i></td>
            </tr>
            <tr>
              <td>Formular</td>
              <td>2</td>
              <td>Igangværende</td>
              <td>1 kommentar</td>
              <td><i class="fa fa-angle-down" style="font-size:36px"></i></td>
            </tr>
            <tr>
              <td>Dashboard</td>
              <td>2</td>
              <td>ventende</td>
              <td>1 kommentar</td>
              <td><i class="fa fa-angle-down" style="font-size:36px"></i></td>
            </tr>
            <tr>
              <td>Ændring i menubar</td>
              <td>2</td>
              <td>Igangvære</td>
              <td>1 kommentar</td>
              <td><i class="fa fa-angle-down" style="font-size:36px"></i></td>
            </tr>
            <tr>
              <td>Formular</td>
              <td>2</td>
              <td>Igangværende</td>
              <td>1 kommentar</td>
              <td><i class="fa fa-angle-down" style="font-size:36px"></i></td>
            </tr>
            <tr>
              <td>Dashboard</td>
              <td>2</td>
              <td>ventende</td>
              <td>1 kommentar</td>
              <td><i class="fa fa-angle-down" style="font-size:36px"></i></td>
            </tr>
            <tr>
              <td>Ændring i menubar</td>
              <td>2</td>
              <td>Igangvære</td>
              <td>1 kommentar</td>
              <td><i class="fa fa-angle-down" style="font-size:36px"></i></td>
            </tr>
            <tr>
              <td>Formular</td>
              <td>2</td>
              <td>Igangværende</td>
              <td>1 kommentar</td>
              <td><i class="fa fa-angle-down" style="font-size:36px"></i></td>
            </tr>
            <tr>
              <td>Dashboard</td>
              <td>2</td>
              <td>ventende</td>
              <td>1 kommentar</td>
              <td><i class="fa fa-angle-down" style="font-size:36px"></i></td>
            </tr>
            <tr>
              <td>Ændring i menubar</td>
              <td>2</td>
              <td>Igangvære</td>
              <td>1 kommentar</td>
              <td><i class="fa fa-angle-down" style="font-size:36px"></i></td>
            </tr>
          </tbody>
        </table>
      </div>
</body>
</html>

<script>
  /* ajax kald */
  let ajax = new XMLHttpRequest();
  ajax.open("GET", "http://localhost/roadmap/PHP/dbCon/Api.php?action=tasks", true);
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

        console.log("hej");
        let firstName = dataTasks[i].navn;
        let isStatus = dataTasks[i].status;

        console.log(firstName);
        
        /* appender til html */
        html += "<tr>";
          html += "<td>" + firstName + "</td>";
        html += "</tr>";
      }

      /* erstater <tbody> af <table> */
      document.getElementById("dataTop3").innerHTML += html;
    }
  }
</script>