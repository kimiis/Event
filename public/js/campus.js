let searchCampus = document.getElementById("Campus");


searchCampus.addEventListener("change", ()=> {
    window.location.href = "/tri/" + searchCampus.value
})


