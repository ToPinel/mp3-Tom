document.addEventListener("DOMContentLoaded",function(){
    document.querySelector("#order").addEventListener("change",function(){
        let val = document.querySelector("#order").value;
        document.location.href="index.php?order="+val;  
    })
})