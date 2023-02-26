function nextPrev() {
  // This function will figure out which tab to display
  // if (!validateForm()) return false;

  if(document.getElementById("FirstName").value == "")
  {
    var first_name = trim(document.getElementById("FirstName").value);
    if(first_name=="" || first_name=="Please enter your first name"){
      document.getElementById("FirstName").className = "input_error form-control";
      document.getElementById("FirstName").value = "Please enter your first name";
    }
    return false;
  }

  if(document.getElementById("LastName").value == "")
  {
    var last_name = trim(document.getElementById("LastName").value);
    if(last_name=="" || last_name=="Please enter your last name"){
      document.getElementById("LastName").className = "input_error form-control";
      document.getElementById("LastName").value = "Please enter your last name";
    }
    return false;
  }
  
  if(document.getElementById("Numberplate").value == "")
  {
    var numberPlate = trim(document.getElementById("Numberplate").value);
    if(numberPlate == "" || numberPlate == "Please enter your registeration"){
      document.getElementById("Numberplate").className = "input_error form-control";
      document.getElementById("Numberplate").value = "Please enter your registeration";
    }
    return false;
  }


  var tab1 = document.getElementsByClassName("tab1")[0];
  var tab2 = document.getElementsByClassName("tab2")[0];
  tab1.style.display = 'none';
  tab2.style.display = 'flex';

  if(document.getElementById("nextBtn").innerHTML == "Submit") {
    // document.getElementById("quotation").submit();
    chkSellRegister();
  }

  document.getElementById("nextBtn").innerHTML = "Submit";
}
