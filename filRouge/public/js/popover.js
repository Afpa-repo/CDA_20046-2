// ancien code de compatibilité, aujourd’hui inutile
if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+...
  httpRequest = new XMLHttpRequest();
}
else if (window.ActiveXObject) { // IE 6 et antérieurs
  httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
}


(function() {
  var httpRequest;
  document.getElementById("radio-format-1").addEventListener('change', makeRequest);

  function makeRequest() {
    httpRequest = new XMLHttpRequest();

    if (!httpRequest) {
      alert('Abandon :( Impossible de créer une instance de XMLHTTP');
      return false;
    }
    httpRequest.onreadystatechange = alertContents;
    httpRequest.open('GET', 'show.html.twig');
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send();
  }

  function alertContents() {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        alert(httpRequest.responseText);
      } else {
        alert('Il y a eu un problème avec la requête.');
      }
    }
  }
})();



$(function () {
    $('[data-toggle="popover"]').popover()
  })

  // $(document).ready(function(){
  //     $('.formulaire').submit(function(){

  //       var format = $('.formCheckFormat').val();
  //       var mat = $('.formCheckMat').val();
  //       var qte = $('.formCheckQte').val();

  //       alert (format + mat + qte);
    
  //     });

  //   });

