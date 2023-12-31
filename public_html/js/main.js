
let burgerButton = document.getElementById("burger-menu");
let torchPointer = document.getElementById('torch-pointer');
let menuOpen = false;
let logRegSubmit = document.getElementById("log-reg-submit");
let logRegErrorMsg = document.getElementById("log-reg-error-msg");

const openNameMC = (info) => {
    window.open('https://www.namemc.com/profile/'+info, '_blank');
}
const confirmDelete = (postId) => {
    // Personnalisez le message de confirmation
    var customMessage = "Êtes-vous sûr de vouloir supprimer ce post ? Cette action est irréversible.";

    // Utiliser SweetAlert2 pour afficher une boîte de dialogue personnalisée
    Swal.fire({
        icon: 'warning', // Icône d'avertissement
        title: 'Confirmation', // Titre de la boîte de dialogue
        text: customMessage, // Message personnalisé
        showCancelButton: true, // Afficher le bouton Annuler
        confirmButtonText: 'Oui, supprimer', // Texte du bouton de confirmation
        cancelButtonText: 'Annuler', // Texte du bouton Annuler
        confirmButtonColor: '#ff0000', // Couleur du bouton de confirmation (rouge ici)
    }).then((result) => {
        if (result.isConfirmed) {
            // Si l'utilisateur clique sur le bouton de confirmation, redirigez vers la fonction PHP de suppression
            window.location.href = "/posts/deletePost/" + postId; // Remplacez delete-post.php par le nom du fichier où est définie la fonction deletePost()
        }
    });
}

const confirmLogout = () => {
    // Personnalisez le message de confirmation
    var customMessage = "Es-tu sûr de vouloir te déconnecter.";

    // Utiliser SweetAlert2 pour afficher une boîte de dialogue personnalisée
    Swal.fire({
        icon: 'question', // Icône d'avertissement
        title: 'Se déconnecter', // Titre de la boîte de dialogue
        text: customMessage, // Message personnalisé
        showCancelButton: true, // Afficher le bouton Annuler
        confirmButtonText: 'Se déconnecter', // Texte du bouton de confirmation
        cancelButtonText: 'Annuler', // Texte du bouton Annuler
        confirmButtonColor: '#ff0000', // Couleur du bouton de confirmation (rouge ici)
    }).then((result) => {
        if (result.isConfirmed) {
            // Si l'utilisateur clique sur le bouton de confirmation, redirigez vers la fonction PHP de suppression
            window.location.href = "/users/logout"; // Remplacez delete-post.php par le nom du fichier où est définie la fonction deletePost()
        }
    });
}
const toggleDarkMode = () => {
    const body = document.body;
    body.classList.toggle("dark-mode");
    burgerMenu()

    // Sauvegarde la préférence de l'utilisateur dans localStorage
    const isDarkModeEnabled = body.classList.contains("dark-mode");
    localStorage.setItem("darkMode", isDarkModeEnabled);
    if (isDarkModeEnabled){
        document.getElementById("dark-light-switch").setAttribute("src", "/assets/images/moon.svg")
    } else {
        document.getElementById("dark-light-switch").setAttribute("src", "/assets/images/sun.svg")
    }

}

// Vérifie si le thème sombre est activé dans localStorage
const isDarkModeEnabled = localStorage.getItem("darkMode") === "true";

if (isDarkModeEnabled) {
    document.body.classList.add("dark-mode");
    document.getElementById("dark-light-switch").setAttribute("src", "/assets/images/moon.svg")
}
const burgerMenu = () => {
    if (menuOpen){
        burgerButton.setAttribute("data-state","close");
        document.getElementById("nav-items").setAttribute("data-state","close");
        menuOpen = false
    } else {
        burgerButton.setAttribute("data-state","open");
        document.getElementById("nav-items").setAttribute("data-state","open");
        menuOpen = true
    }
}

// document.addEventListener("scroll", function(event) {
//     if (window.scrollY > 1) {
//         document.querySelector(".navbar").setAttribute("style", "-webkit-box-shadow: 0px 5px 15px 0px rgba(0,0,0,0.2); box-shadow: 0px 5px 15px 0px rgba(0,0,0,0.2);")
//     } else {
//         document.querySelector(".navbar").removeAttribute("style")
//     }
// })

if (torchPointer != null){
    document.addEventListener('mousemove', function(event) {
        let torchPointer = document.getElementById('torch-pointer');
        let offsetX = event.clientX - 10; // Décalage horizontal
        let offsetY = event.clientY - 10; // Décalage vertical
        if (event.clientX <= 1 || event.clientX >= (window.innerWidth - 12) || event.clientY <= document.querySelector(".navbar").clientHeight || event.clientY >= (window.innerHeight - document.querySelector(".footer").clientHeight)) {
            torchPointer.style.opacity = 0
            return;
        } else {
            torchPointer.style.opacity = 1 
        }
      
        setTimeout(function() {
          torchPointer.style.left = offsetX + 'px';
          torchPointer.style.top = offsetY + 'px';
        }, 100);
      });
}

let usernameInput = document.getElementById("minecraft");
let uuidInput = document.getElementById("minecraftuuid");


const uuidCalculator = () => {
    /*if (uuidValue != ""){
      alert("Retire le texte que tu as mis dans Minecraft UUID sinon ça ne marchera pas.")
      return;
    };*/
    let username = document.getElementById("minecraft").value;
    let uuidValue = document.getElementById("minecraftuuid").value;
    
    if (/^[a-zA-Z0-9_]{2,16}$/mg.test(username) == true){


        var url = "https://playerdb.co/api/player/minecraft/" + username;

        var xhr = new XMLHttpRequest();
        xhr.open("GET", url);

        xhr.onreadystatechange = function () {
           if (xhr.readyState === 4) {
              console.log(xhr.status);
              console.log(xhr.responseText);
              let json = xhr.responseText;
              let obj = JSON.parse(json);

              if (obj.success === true){


                usernameInput.value = obj.data.player.username;
                usernameInput.setAttribute("readonly", "");
                uuidInput.value = obj.data.player.id;
                uuidInput.setAttribute("readonly", "");

                document.getElementById("uuidbutton").removeAttribute("onclick");
                document.getElementById("uuidbutton").setAttribute("value", "UUID trouvé !");

                document.getElementById("report-left-player").setAttribute("src", "https://crafatar.com/renders/body/" + obj.data.player.id +"?overlay")



              } else {
                  //alert("Impossible de trouver le joueur dans la DB.\n\nVérifiez sur NameMC\nhttps://fr.namemc.com/profile/" + username);
                  Swal.fire({
                      icon: 'warning', // Icône d'avertissement
                      title: 'Joueur introuvable', // Titre de la boîte de dialogue
                      text: "Impossible de trouver le joueur dans la DB.\n\nVérifiez sur NameMC", // Message personnalisé
                      confirmButtonText: 'OK', // Texte du bouton de confirmation
                      footer: `<a href="https://fr.namemc.com/profile/`+username+`" target="_blank">Vérifier sur NameMC</a>`
                  });
              }
              
              
           }};
       
        xhr.send();
        

    } else {
        if (username === ""){
            Swal.fire({
                icon: 'warning', // Icône d'avertissement
                title: 'Joueur vide', // Titre de la boîte de dialogue
                text: "Donne au moins un pseudo... Sinon ça va être difficile.", // Message personnalisé
                confirmButtonText: 'OK', // Texte du bouton de confirmation
            });
        } else {
            Swal.fire({
                icon: 'warning', // Icône d'avertissement
                title: 'Pas un pseudo', // Titre de la boîte de dialogue
                text: "'"+ username + "' n'est pas un pseudo Minecraft.\n\nContrôles et réessaies.", // Message personnalisé
                confirmButtonText: 'OK', // Texte du bouton de confirmation
            });
        }

    }
}
const checkUsername = (element) => {
    if (/^[a-zA-Z0-9_]{2,16}$/mg.test(element.value)) {
        element.classList.remove("incorrect")
        logRegSubmit.removeAttribute("disabled")
        logRegErrorMsg.classList.add("hidden")
    } else {
        element.classList.add("incorrect")
        logRegSubmit.setAttribute("disabled", "")
        logRegErrorMsg.textContent = "Pseudo invalide. Pas de caractères spéciaux."
        logRegErrorMsg.classList.remove("hidden")
    }
}

const checkMail = (element) => {
    if (/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g.test(element.value)) {
        element.classList.remove("incorrect")
        logRegSubmit.removeAttribute("disabled")
        logRegErrorMsg.classList.add("hidden")
    } else {
        element.classList.add("incorrect")
        logRegSubmit.setAttribute("disabled", "")
        logRegErrorMsg.textContent = "Email invalide."
        logRegErrorMsg.classList.remove("hidden")
    }
}

const checkPassword = (element) => {
    if (element.value.length >= 8) {
        element.classList.remove("incorrect")
        logRegSubmit.removeAttribute("disabled")
        logRegErrorMsg.classList.add("hidden")
    } else {
        element.classList.add("incorrect")
        logRegSubmit.setAttribute("disabled", "")
        logRegErrorMsg.textContent = "Mot de passe invalide."
        logRegErrorMsg.classList.remove("hidden")
    }
}

const checkConfirmPassword = (element) => {
    if (element.value === document.querySelector("#password").value && element.value != ""){
        element.classList.remove("incorrect")
        logRegSubmit.removeAttribute("disabled")
        logRegErrorMsg.classList.add("hidden")
    } else if (element.value === ""){
        element.classList.add("incorrect")
        logRegSubmit.setAttribute("disabled", "")
        logRegErrorMsg.textContent = "La confirmation ne peut pas être vide."
        logRegErrorMsg.classList.remove("hidden")
    } else {
        element.classList.add("incorrect")
        logRegSubmit.setAttribute("disabled", "")
        logRegErrorMsg.textContent = "Les mots de passe ne correspondent pas."
        logRegErrorMsg.classList.remove("hidden")
    }
}

// Récupérer le champ de mot de passe
const passwordInput = document.getElementById('password');

// Ajouter un gestionnaire d'événements pour l'événement "input"
passwordInput.addEventListener('input', (event) => {
    // Récupérer la valeur du champ de mot de passe
    const passwordValue = event.target.value;
    if (passwordValue.length >= 8) {
        document.querySelector("#pass-check-char").setAttribute("data-state", "correct")

    } else {
        document.querySelector("#pass-check-char").removeAttribute("data-state")
    }

    if (/[!@#$%^&*(),.?":{}|<>]/.test(passwordValue)) {
        document.querySelector("#pass-check-special").setAttribute("data-state", "correct")
    } else {
        document.querySelector("#pass-check-special").removeAttribute("data-state")
    }

    if (/[A-Z]/.test(passwordValue)) {
        document.querySelector("#pass-check-upper").setAttribute("data-state", "correct")
    } else {
        document.querySelector("#pass-check-upper").removeAttribute("data-state")
    }

    if (/\d/.test(passwordValue)) {
        document.querySelector("#pass-check-number").setAttribute("data-state", "correct")
    } else {
        document.querySelector("#pass-check-number").removeAttribute("data-state")
    }
});