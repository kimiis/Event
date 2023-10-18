let body = document.body;

onload = () => {
    promptCanceled();
}

// faire une popup prompt pour récup le motif
function promptCanceled() {

    let cancelButton = document.getElementById('cancelButton');
    cancelButton.addEventListener('click', function () {

        let reason = prompt("What's the reason?");
        console.log("Reason: " + reason);

    });
}