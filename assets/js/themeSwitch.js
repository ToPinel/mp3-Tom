const themeSwitch = document.getElementById("themeSwitch");
themeSwitch.addEventListener("change", () => {
    // j'utilise une checkbox id="themeSwitch" et son etat checked true/false pour gérer mon theme
    // dark ou light (ici deux themes bootswatch : https://bootswatch.com/)
    // j'envoie avec une variable GET le theme choisi par mon utilisateur
    // ?theme = true/false (ou light/dark)
    window.location.href = "?themeSwitch=" + themeSwitch.checked;
})
