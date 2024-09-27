let button = document.querySelector(".menu");
let menu = document.querySelector(".mobile");
let desktop = document.querySelector(".desktop");

button.addEventListener("click",()=>{
    if(menu.classList.contains("close"))
       
             menu.classList.remove("close")
   
    else{
        menu.classList.add("close");
    }
})

