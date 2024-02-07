const togglemenu = document.getElementById("togglemenu"),
  menumoblie = document.getElementById("mobilemenu");

togglemenu.addEventListener("click", () => {
  if (menumoblie.classList.contains("show")) {
    menumoblie.classList.remove("show");
  } else {
    menumoblie.classList.add("show");
  }
});


const btn_profile = document.getElementById("profile_btn"),
dropdonw = document.getElementById("dropdown_profile");

btn_profile.addEventListener("click", () =>{
    if(dropdonw.classList.contains("show")){
        dropdonw.classList.remove("show");
    }else{
        dropdonw.classList.add("show");
    }
})
