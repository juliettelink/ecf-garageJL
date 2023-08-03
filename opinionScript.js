// Les étoiles pour avis

window.onload = () => {
    //on cherche les étoiles
    const stars = document.querySelectorAll(".la-star");

    // on va chercher l'input
    const note = document.querySelector("#note");
    
    // on boulce sur les étoiles pour ajouter des écouteurs d'évenments
    for(star of stars){
        // on écoute le survol
        star.addEventListener("mouseover", function(){
            resetStars();
            this.style.color = "yellow";
            this.classList.add("las");
            this.classList.remove("lar")


            // element précédent du DOM
            let previousStar = this.previousElementSibling;

            // pour passer en jaune les étoiles qui précedent
            while(previousStar){
                previousStar.style.color = "yellow";
                previousStar.classList.add("las");
                previousStar.classList.remove("lar")
                previousStar = previousStar.previousElementSibling;
            }
        });

        // on écoute le clic
        star.addEventListener("click", function(){
            note.value = this.dataset.value;
        });

        star.addEventListener("mouseout", function(){
            resetStars(note.value);
        });
    }

    function resetStars(note = 0){
        //boucle sur chaques étoiles 
        for(star of stars){
            if(star.dataset.value > note){
                star.style.color = "black";
                star.classList.add("lar");
                star.classList.remove("las")
            }else{
                star.style.color = "yellow";
                star.classList.add("las");
                star.classList.remove("lar")
            }
        }
    }
}