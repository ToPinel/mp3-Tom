document.addEventListener("DOMContentLoaded", () => {

    document.forms['uploadMP3'].addEventListener("submit", function(e) {
        e.preventDefault();
        console.log(e);
        console.dir(document.forms['uploadMP3']);
        const formData = new FormData(document.forms['uploadMP3']);
        console.dir(formData);
        fetch("./validator.php", {
                method: "POST",
                body: formData
            })
            .then(function(response) {
                response.json().then(
                    function(result) {
                        //console.dir(json.json());
                        for (let indice in result) {
                            if (document.querySelector('#' + indice + "Msg")) {
                                document.querySelector('#' + indice + "Msg").remove();
                                document.querySelector('#' + indice).style.border = "1px red black";
                            }
                            let divErreur = document.createElement("div");
                            divErreur.classList.add("inputError");
                            divErreur.id = indice + " Msg";
                            divErreur.innerText = result[indice];
                            document.querySelector('#' + indice).after(divErreur);
                            document.querySelector('#' + indice).style.border = "1px red solid";
                            //divErreur.after(document.queryselector('#'.indice))
                            //document.getElementById("success").innerHTML += result[indice] + "<br>";
                        }
                    });
            })
            .then((error) => {
                console.log(error);
            })
    })
})