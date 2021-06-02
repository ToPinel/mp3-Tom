document.addEventListener("DOMContentLoaded",function(){
    // déclarations valeurs et variables
    // nombre d'images dans le carousel
    //
    let nbImages = 50;
    // temps de défilement des images en ms
    let time = 4000;
    // temps de transitionCSS en ms
    let timeCssTrans = 2000;
    // width du carousel en px
    let carouselWidth = 1920;
    // height du carousel en px
    let carouselHeight = 150;
    // emplacement dans l'HTML du carousel (ici en tête du <body></body>)
    let carouselParent = document.getElementById('slider');
    // types d'effets de défilement d'images
    // fadeOut,translateUp,translateLeft,...
    let transition = "translateUp";
    const imgArray = [];
    // creation du tableau d'images
    let i = 0;
    while (i<nbImages) {
      imgArray[i]  = "https://picsum.photos/"+carouselWidth+"/"+carouselHeight+"?random="+(i+1);
      i++;  
    }
    // creation des class CSS de transition dans une balise style
    const style = document.createElement('style');
    style.type = 'text/css';
    style.innerHTML = '.fadeOut{'+
        'opacity: 0;'+
        'transition: opacity '+timeCssTrans+'ms;'+
    '}'+
    '.translateLeft{'+
        'transform: translateX(-'+carouselWidth+'px);'+
        'transition: all '+timeCssTrans+'ms;'+
   ' }'+
   '.translateUp{'+
        'transform: translateY(-'+carouselHeight+'px);'+
        'transition: all '+timeCssTrans+'ms;'+
   ' }';
   
    document.getElementsByTagName('head')[0].appendChild(style);
    //construction de mes éléménts
    const carousel = document.createElement("div");
    carousel.classList.add("carousel");
    carousel.style.width = carouselWidth+"px";
    carousel.style.height = carouselHeight+"px";
    carousel.style.position = "relative";
    carousel.style.overflow = "hidden";
    carouselParent.prepend(carousel);
    

    //imageA (qui va disparaître)
    const imageA = document.createElement("img");
    imageA.src = imgArray[0];
    imageA.id = "imageA";
    imageA.alt = "blablabla";
    imageA.style.width = "100%";
    imageA.style.minHeight = "100%";
    imageA.style.position = "absolute";
    // ajouts d'effet?
    carousel.prepend(imageA);

    //imageB (qui va rester fixe)
    const imageB = document.createElement("img");
    imageB.src = imgArray[1];
    imageB.id = "imageB";
    imageB.alt = "blablabla";
    imageB.style.width = "100%";
    imageB.style.minHeight = "100%";
    imageB.style.position = "absolute";
    // ajouts d'effet?
    carousel.prepend(imageB);

    // logique du programme
    i=0;
    const loop = setInterval(function(){
        // si i >= à la taille entrée de mon tableau le ramener à 0
        if(i>=imgArray.length){
            i = 0;
        }
        // changer l'image B cachée derriere l'image A
        imageB.src = imgArray[i+1];
        // effet de transition sur A
        imageA.classList.add(transition);
        // incrémentation de i
        i++;
        // le setTimeout me sert à attendre la fin de ma transition css
        setTimeout(()=>{
            // changer l'image A
            imageA.src = imgArray[i];
            // et la ramener sur l'image B pour la masquer 
            imageA.classList.remove(transition);
        // le setTimeout doit durer le même temps que ma transition css
        },timeCssTrans)
    },time)
})