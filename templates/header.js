const logEl= document.getElementById("log-el");

let loggedin = "<?php echo $isLoggedin;?>"

console.log(loggedin)

if(loggedin == 1)
{
    logEl.value="Logout"

}else{
    logEl.value="Login"
}

function log(){
    
}


