// let body = document.body;
//
// onload = () => {
//     promptCanceled();
// }
//
// // faire une popup prompt pour récup le motif
// function promptCanceled() {
// console.log("coucou")
//     let cancelButton = document.getElementById('cancelButton');
//     cancelButton.addEventListener('click', function (event) {
//         console.log(event.target.name)
//         let reason = prompt("What's the reason?");
//         console.log("Reason: " + reason);
//         // ici une fois que l'utilisateur à tapé la raison d'annulation, on redirige vers la page d'annulation
//         // on lui passe dans l'url l'id de l'event qui est donc utilisable dans le controller
//         document.location = `/canceled/${event.target.name}/${encodeURI(reason)}`
//     });
// }
//
// let searchCampus = document.getElementById("Campus");
// searchCampus.addEventListener("change", ()=> {
//     window.location.href = "/tri/" + searchCampus.value
// })
//

// const inputField = document.querySelector('.chosen-value');
// const dropdown = document.querySelector('.value-list');
// const dropdownArray = [... document.querySelectorAll('li')];
// // inputField : Il s'agit du champ de saisie (input) qui permet à l'utilisateur de taper du texte.
// // dropdown : C'est l'élément qui contient la liste déroulante des éléments à choisir.
// // dropdownArray : C'est un tableau (Array) qui contient tous les éléments de liste (balises <li>) dans la liste déroulante.
//
// console.log(typeof dropdownArray)
// dropdown.classList.add('open');
// //  ajoute la classe CSS "open" à l'élément de liste déroulante, ce qui le rend initialement visible.
//
// inputField.focus();
// // met le focus sur le champ de saisie, ce qui signifie que le curseur se trouve dans le champ de saisie
// // et que l'utilisateur peut immédiatement commencer à taper du texte. Cette ligne est principalement utilisée à des fins de démonstration.
//
// let valueArray = [];
// //  un tableau vide initialisé pour stocker les valeurs des éléments de liste.
// dropdownArray.forEach(item => {
//     valueArray.push(item.textContent);
// });
// // Une boucle forEach parcourt tous les éléments de liste (dropdownArray) et ajoute leur contenu (texte) à valueArray. Ainsi, valueArray contient maintenant toutes les valeurs de la liste déroulante.
// const closeDropdown = () => {
//     dropdown.classList.remove('open');
// }
// // est utilisé pour cacher la liste déroulante en retirant la classe "open" de l'élément de la liste déroulante, rendant ainsi ses éléments invisibles à l'écran.
//
// // ------------------------------------------
//
// // L'événement input est écouté sur le champ de saisie (inputField). Lorsque l'utilisateur tape du texte dans le champ, cette fonction est appelée. Elle fait ce qui suit :
//
// // Elle ajoute la classe "open" à la liste déroulante, ce qui la rend visible.
// // Elle obtient la valeur actuelle du champ de saisie en minuscules (inputValue).
// // Elle parcourt les éléments de valueArray et cache les éléments de liste qui ne correspondent pas au texte tapé par l'utilisateur en ajoutant la classe "closed". Les éléments correspondants restent visibles.
//
// inputField.addEventListener('input', () => {
//     dropdown.classList.add('open');
//     // utilisé pour afficher la liste déroulante en ajoutant la classe "open" à l'élément de la liste déroulante, ce qui a pour effet de rendre ses éléments visibles à l'écran.
//     let inputValue = inputField.value.toLowerCase();
//     let valueSubstring;
//     if (inputValue.length > 0) {
//         for (let j = 0; j < valueArray.length; j++) {
//             if (!(inputValue.substring(0, inputValue.length) === valueArray[j].substring(0, inputValue.length).toLowerCase())) {
//                 dropdownArray[j].classList.add('closed');
//             } else {
//                 dropdownArray[j].classList.remove('closed');
//             }
//         }
//     } else {
//         for (let i = 0; i < dropdownArray.length; i++) {
//             dropdownArray[i].classList.remove('closed');
//         }
//     }
// });
// // ajoute un écouteur d'événement "click" à chaque élément de liste. Lorsqu'un élément de liste est cliqué, sa valeur est copiée dans le champ de saisie, et toutes les classes "closed"
// // sont ajoutées à tous les éléments de liste, ce qui les cache à nouveau.
// dropdownArray.forEach(item => {
//     item.addEventListener('click', (evt) => {
//         inputField.value = item.textContent;
//         dropdownArray.forEach(dropdown => {
//             dropdown.classList.add('closed');
//         });
//     });
// })
// // L'événement focus sur le champ de saisie remplace le texte de l'attribut placeholder pour donner des indications à l'utilisateur et rend la liste déroulante visible.
// inputField.addEventListener('focus', () => {
//     inputField.placeholder = 'Type to filter';
//     dropdown.classList.add('open');
//     dropdownArray.forEach(dropdown => {
//         dropdown.classList.remove('closed');
//     });
// });
// // L'événement blur sur le champ de saisie restaure le texte de l'attribut placeholder à sa valeur initiale et cache la liste déroulante.
// inputField.addEventListener('blur', () => {
//     inputField.placeholder = 'Select state';
//     dropdown.classList.remove('open');
// });
// // Enfin, un événement global est ajouté à document pour détecter les clics en dehors de la liste déroulante et du champ de saisie. Si l'utilisateur clique en dehors de ces éléments,
// // la liste déroulante est cachée en supprimant la classe "open".
// document.addEventListener('click', (evt) => {
//     const isDropdown = dropdown.contains(evt.target);
//     const isInput = inputField.contains(evt.target);
//     if (!isDropdown && !isInput) {
//         dropdown.classList.remove('open');
//     }
// });
//
//
