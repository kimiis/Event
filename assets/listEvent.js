let body = document.body;

onload = () => {
    promptCanceled();
}

// faire une popup prompt pour récup le motif
function promptCanceled() {

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
function sceneOne() {
    var tl = new TimelineMax();

    tl.add("begin", "+=1");
    tl.fromTo(".pumpkin", 2, {
        scale: 0,
        x: 0,
        y: 0,
        rotation: 180
    }, {
        scale: 1,
        bezier: {
            type: "soft",
            values: [{
                x: 400,
                y: 175
            }, {
                x: 30,
                y: 250
            }],
            autoRotate: false
        },
        rotation: 0,
        ease: Circ.easeInOut
    }, "begin+=1");
    tl.to("#face, #back-area", 1, {
        opacity: 0.5,
        yoyo: true,
        repeatDelay: 0.65,
        repeat: -1,
        ease: RoughEase.ease.config({ template:  Power0.easeNone, strength: 1, points: 20, taper: "none", randomize:  true, clamp: false})
    }, "begin+=3");
    tl.from("h1", 2, {
        opacity: 0,
        ease: RoughEase.ease.config({ template:  Power0.easeNone, strength: 1, points: 20, taper: "none", randomize:  true, clamp: false})
    }, "begin+=3");
    tl.from("h1", 1, {
        rotationX: 180,
        ease: Sine.easeOut
    }, "begin+=3");

    return tl;
}

//add it all to master timeline
var master = new TimelineMax();
master.add(sceneOne(), "first");
