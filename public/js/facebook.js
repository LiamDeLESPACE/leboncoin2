window.fbAsyncInit = function() {
    FB.init({
      appId      : '1414076776131818', // Remplacez par l'ID de votre application Facebook
      cookie     : true,
      xfbml      : true,
      version    : 'v18.0' // Assurez-vous de spécifier une version valide
    });
      
    FB.AppEvents.logPageView();   
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

   