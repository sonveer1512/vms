 // active input-field and label

 $(document).ready(function()
{
    $('.input-field input').focus(function()
     {
        $(this).closest('.focus').toggleClass("focused");
          })
    .blur(function(){
       
        $(this).closest('.focus').toggleClass("focused");
    });
     $('.input-field select').focus(function()
     {
        $(this).closest('.focus').toggleClass("focused");
          })
    .blur(function(){
       
        $(this).closest('.focus').toggleClass("focused");
    });
});

// password show/hide

 $(".toggle-icon").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

// Password Strength Check
var passcheck = document.getElementById("password-field");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");


passcheck.onkeyup = function()
{
    
    let pass_meter = 0;

    
    // Check lowercase letter
    var lowerCaseLetters = /[a-z]/g;
    if(passcheck.value.match(lowerCaseLetters)) 
    {  
        letter.classList.remove("fa-xmark");
        letter.classList.add("fa-check");
        pass_meter +=1;
    } 
  else
    {
        letter.classList.remove("fa-check");
        letter.classList.add("fa-xmark");
    }
  
    // check Uppercase letters
    var upperCaseLetters = /[A-Z]/g;
    if(passcheck.value.match(upperCaseLetters))
    {  
        capital.classList.remove("fa-xmark");
        capital.classList.add("fa-check");
        pass_meter +=1;
    }
    else
    {
        capital.classList.remove("fa-check");
        capital.classList.add("fa-xmark");
    }

    // Check numbers
    var numbers = /[0-9]/g;
    if(passcheck.value.match(numbers))
    {  
        number.classList.remove("fa-xmark");
        number.classList.add("fa-check");
        pass_meter +=1;
    }
    else
    {
        number.classList.remove("fa-check");
        number.classList.add("fa-xmark");
     }
  
    // Validate length
    if(passcheck.value.length >= 6)
    {
        length.classList.remove("fa-xmark");
        length.classList.add("fa-check");
        pass_meter +=1;
    }
    else
    {
        length.classList.remove("fa-check");
        length.classList.add("fa-xmark");
  }

  // password meter
  if (pass_meter == 1)
  {
    passmeter.style = 'width: 25%; background: #ff4444';

  }
 else if (pass_meter == 2)
  {
     passmeter.style = 'width: 50%; background: #ffbb33;';
  }
   else if (pass_meter == 3)
  {
    passmeter.style = 'width: 75%; background: #ffbb33';
  }
   else if (pass_meter == 4)
  {
    passmeter.style = 'width: 100%; background: rgb(120, 197, 115)';
    
  }
   else
  {
    passmeter.style.cssText = 'width: 0%';
  }
}





// disable on enter
$('form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});









// form validiation
var inputschecked = false;


function formvalidate()
{
  // check if the required fields are empty
  inputvalue = $("#steps :input").not("button").map(function()
  {
    if(this.value.length > 0)
    {
      $(this).removeClass('invalid');
      return true;

    }
    else
    {
      
      if($(this).prop('required'))
      {
        $(this).addClass('invalid');
        return false
      }
      else
      {
        return true;
      }
      
    }
  }).get();
  

  // console.log(inputvalue);

  inputschecked = inputvalue.every(Boolean);

  // console.log(inputschecked);
}




$(document).ready(function()
 {
     $("#sub").on('click' , function()
     {

        formvalidate();

          // get input value
          var email = $("#mail-email").val();
          var phone = $("#phone").val();
          var zip = $("#zip").val();          
          //number validiation
          var numbers = /^[0-9]+$/;
          //email validiation
          var re = /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
          var emailFormat = re.test(email);


          if(inputschecked == false)
          {
            formvalidate();
          }
          
          // else if(!zip.match(numbers) || !phone.match(numbers))
          // {

          //     console.log("invalid number");

          //   }
          
          // check if email is valid
          else if(emailFormat == false)
          {
            (function (el) {
              setTimeout(function () {
                  el.children().remove('.reveal');
              }, 3000);
            }($('#error').append('<div class="reveal alert alert-danger">Email address is invalid!</div>')));
            if(emailFormat == true)
            {
              $("#mail-email").removeClass('invalid');
            }
            else
            {
              $("#mail-email").addClass('invalid');
            }

          }
          
          else
          {
              $("#sub").html("<img src='assets/images/loading.gif'>");

              

              var dataString = new FormData(document.getElementById("steps"));


              console.log(dataString);

              
              // send form to send.php
              $.ajax({
                        type: "POST",
                        url: "form handling/send.php",
                        data: dataString,
                        processData: false,
                        contentType: false,
                        cache: false,
                       success: function(data,status)
                       {

                          $("#sub").html("Success!");
                          console.log(data);
                          
                          // window.location = "thankyou.html";
                          
                       },
                       error: function(data, status)
                       {
                          $("#sub").html("failed!");
                          console.log(data);
                       }
                    });
          }

      });
 }
 );


 