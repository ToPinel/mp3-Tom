const recherche = document.getElementById("recherche");
const divAutoComp = document.querySelector(".divAutoComp");
let valRecherche;
divAutoComp.addEventListener("mouseleave", () => {
    divAutoComp.style.display = "none";
})
recherche.addEventListener("keyup", () => {
    divAutoComp
    valRecherche = recherche.value;
    let data = "recherche=" + valRecherche
    fetch("./inc/recherche.php", {
            method: "POST",
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: data
        })
        .then(response => {
            return response.json()
                .then((monText) => {
                    if (monText.length > 0) {
                        divAutoComp.style.display = "block";
                        monText.forEach(element => {
                            console.dir(element.title);
                            divAutoComp.innerHTML += "<a href='single.php?id=" + element.id + "'>" + element.title + " | " + element.artiste + "</a><br/>";
                        });
                    }
                })
        })
})