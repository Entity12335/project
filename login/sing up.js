window.addEventListener("DOMContentLoaded",()=>{
    const togglePassword = document.querySelector("#seepass");
    const password1 = document.querySelector("#password1");
    const password2 = document.querySelector("#password2");

    togglePassword.addEventListener("click",() => {
        
        const type1 = password1.getAttribute("type") === "password" ? "text" : "password";
        const type2 = password2.getAttribute("type") === "password" ? "text" : "password";
        
        password1.setAttribute("type", type1);
        password2.setAttribute("type", type2);
    })
})