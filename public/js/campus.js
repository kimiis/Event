let body = document.body;

onload = () => {
    promptCanceled();
}

// faire une popup prompt pour récup le motif
function promptCanceled() {
    console.log("coucou")
    let cancelButton = document.getElementById('cancelButton');
    cancelButton.addEventListener('click', function (event) {
        console.log(event.target.name)
        let reason = prompt("What's the reason?");
        console.log("Reason: " + reason);
        // ici une fois que l'utilisateur à tapé la raison d'annulation, on redirige vers la page d'annulation
        // on lui passe dans l'url l'id de l'event qui est donc utilisable dans le controller
        document.location = `/canceled/${event.target.name}/${encodeURI(reason)}`
    });
}

let searchCampus = document.getElementById("Campus");
searchCampus.addEventListener("change", ()=> {
    window.location.href = "/tri/" + searchCampus.value
})
//