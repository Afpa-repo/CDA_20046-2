// ancien code de compatibilité, aujourd’hui inutile
if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+...
    httpRequest = new XMLHttpRequest();
  }
  else if (window.ActiveXObject) { // IE 6 et antérieurs
    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
  }
  
console.log("pwet")


// $("#formcom").submit(function () { //Recup de la soumission du formulaire
//     format = $(this).find("input[name=format]").val();
//     matos = $(this).find("input[name=matos]").val();
//     console.log(format + matos);
//     // $.post(addtest.php, {format:format, matos:matos, function(data){
//     //     if(data!="ok") {
//     //         $(".error").empty().append(data);
//     //     }
//     //     else{
//     //         $("resultAjax").hide.append(format+"a écrit :<div class=\com\">"+com"</div").slideDown;
//     //         $("#formcom").slideUp();
//     //     }
//     // });
//     // return false;
  
//   });




// Fonction d'envoi des valeurs format et matos au controller
function comboPrice(format, matos) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      document.getElementById("price").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "http://127.0.0.1:8000/product/1/"+format+"/"+matos, true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhttp.send();
  }


// Récupération des valeurs des inputs format et matos 
document.getElementById("formcom").addEventListener("submit",(e)=>{ //=function(){}
e.preventDefault();
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

comboPrice(param1, param2)

})