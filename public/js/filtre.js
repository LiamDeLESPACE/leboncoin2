let boutonTypeLogement = document.querySelectorAll("input[name=typelogement]")
let annonceTypeLogement = document.querySelectorAll(".annonce")

boutonTypeLogement.forEach(bouton => {
    bouton.addEventListener('click', () => {
        console.log(bouton.value)
        annonceTypeLogement.forEach(annonce =>{
            //console.log(annonce.querySelector(".typelogement").innerHTML)
            //console.log(bouton.value)
            
            if (bouton.value=="Tout"){
                annonce.style.display = "inline-block";
            }
            else if(annonce.querySelector(".typelogement").innerHTML != bouton.value){
                annonce.style.display = "none";
            }
            else{
                annonce.style.display = "inline-block";
            }
        });
    });
  });

  const form = document.querySelector('form');

  // Quand on submit
  form.addEventListener("submit", (event) => {
    // On empêche le comportement par défaut
    event.preventDefault();
    console.log(form)
    if(event.submitter.value=="Filtrer" || event.submitter.value=="Charger")
    {
        form.action="/annonces"
    }
    else
    {
        form.action="/create-recherche/registration"
    }
    form.submit()

    // On récupère les deux champs et on affiche leur valeur
    /*const nom = document.getElementById("nom").value;
    const email = document.getElementById("email").value;
    console.log(nom);
    console.log(email);*/
});