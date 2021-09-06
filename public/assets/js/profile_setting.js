document.addEventListener('DOMContentLoaded', function() {
    let days = document.getElementsByClassName("days_circle-d");
    Array.from(days).forEach( elm => {
        elm.addEventListener( "click" , changeColor);
    })

    function changeColor() {
        var day_name =this.getAttribute("data-parent");
        console.log(this.getAttribute("data-parent"));
        if(this.checked){
            this.parentElement.classList.remove("white_border-s");
            this.parentElement.classList.add("mustard_border-s");
            document.getElementById(day_name).classList.remove("text-white");
            document.getElementById(day_name).classList.add("fg_mustard-s");
        }
        else{
            this.parentElement.classList.remove("mustard_border-s");
            this.parentElement.classList.add("white_border-s");
            document.getElementById(day_name).classList.remove("fg_mustard-s");
            document.getElementById(day_name).classList.add("text-white");
        }
    }
});
