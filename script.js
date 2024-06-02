

const form = document.getElementById('myform');

form.addEventListener('submit', function(e){
    var username = document.getElementById('name').value;
    var password = document.getElementById('password').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value
    
    var nameerror = document.getElementById('nameerror');
    var passworderror = document.getElementById('passworderror');
    var emailerror = document.getElementById('emailerror');
    var phoneerror = document.getElementById('phoneerror');
    
// e.preventDefault();

nameerror.innerHTML=""
  emailerror.innerHTML = "";
  passworderror.innerHTML = "";
  phoneerror.innerHTML = "";

  if(username==="")
    {
        nameerror.innerHTML="USERNAME CANT BE EMPTY";
        e.preventDefault();
    }

if(email === "")
    {
        emailerror.innerHTML="email empty";
        e.preventDefault();
    }
    else
    {
        if(!checkEmail(email))
            {
                emailerror.innerHTML="email format wrong";
                e.preventDefault();
            }
    }
if(password==="")
    {
        passworderror.innerHTML='password daal saale';
        e.preventDefault();
    }
    else
    {
            if(password.length < 8)
            {
                passworderror.innerHTML = "length > 8 is required ";
                e.preventDefault();
            }
    }

    if (phone === "") {
        phoneerror.innerHTML = "Phone number is required";
        e.preventDefault();
      } else if (!checkPhone(phone)) {
        phoneerror.innerHTML = "Invalid phone number format";
        e.preventDefault();
      }
}, false);

function checkEmail(email)
{
    var regex = /\S+@\S+\.\S+/;
    return regex.test(email);
}

function checkPhone(phone)
{
    var regex = /^\d{10}$/;
    return regex.test(phone);
}