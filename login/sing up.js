window.addEventListener("DOMContentLoaded",()=>{
    const togglePassword = document.querySelector("#seepass");
    const password = document.querySelector("#password1");

    togglePassword.addEventListener("click",() => {
        
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
    })
})