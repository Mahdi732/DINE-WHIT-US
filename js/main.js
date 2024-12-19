let tryIt = document.getElementById("try");
let check = document.getElementById("check");
let signupName = document.getElementById("signupName");
let signupPrenom = document.getElementById("signupPrenom");
let signupEmail = document.getElementById("signupEmail");
let signupPassword = document.getElementById("signupPassword");
let confirmPassword = document.getElementById("confirmPassword");
function showLogin() {
    document.getElementById('loginForm').classList.remove('hidden');
    document.getElementById('signupForm').classList.add('hidden');
    
    document.getElementById('loginTab').classList.add('bg-gray-100');
    document.getElementById('signupTab').classList.remove('bg-gray-100');
}

function showSignup() {
    document.getElementById('loginForm').classList.add('hidden');
    document.getElementById('signupForm').classList.remove('hidden');
    
    document.getElementById('loginTab').classList.remove('bg-gray-100');
    document.getElementById('signupTab').classList.add('bg-gray-100');
}
tryIt.addEventListener("click", _ => {
    if (signupName.value.trim() !== "" && signupPrenom.value.trim() !== "" && signupEmail.value.trim() !== "" && signupPassword.value.trim() !== "" && confirmPassword.value.trim() !== "" ) {
        if (signupPassword.value.trim() === confirmPassword.value.trim()) {
            if (check.checked) {
            }else{
                alert("check it");
                event.preventDefault();
            }
        }else{
            alert("pass");
            event.preventDefault();
        }
    }else{
        alert("r");
        event.preventDefault();
    }
    
});

