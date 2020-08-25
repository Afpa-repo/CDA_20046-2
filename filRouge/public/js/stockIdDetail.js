// ancien code de compatibilité, aujourd’hui inutile
if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+...
    httpRequest = new XMLHttpRequest();
  }
  else if (window.ActiveXObject) { // IE 6 et antérieurs
    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
  }

// Fonction d'envoi des valeurs format et matos au controller
function ajax(format, matos) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
        console.log(this.responseText)
      document.getElementById("price").innerHTML = this.responseText;
      }
    };
    xhttp.open("POST", "http://127.0.0.1:8000/product/1/"+format+"/"+matos, true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhttp.send(format, matos);
  }


function calcul() {

  formats = document.getElementsByName("format");
  matoss = document.getElementsByName("matos");
  
  
  for (format of formats){
      if (format.checked)
      {
          var param1=format.value
      }
  }
  for (matos of matoss){
      if (matos.checked)
      {
          var param2=matos.value
      }
  }

console.log(param1, param2);
  
ajax(param1, param2)
}
calcul()

tab1 = document.querySelectorAll(".formCheckFormat");
tab2 = document.querySelectorAll(".formCheckMat");

console.log(tab1)
// Récupération des valeurs des inputs format et matos 

for(var i=0; i<tab1.length; i++) {
  console.log(tab1[i])
  tab1[i].onclick = calcul
}

for(var i=0; i<tab2.length; i++) {
  tab2[i].addEventListener("click",  () => {
    calcul()
    console.log("test2")
  });
}