

$(document).ready(() => {
  let currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

});


function showTab(n) {
    // This function will display the specified tab of the form ...
    let tab = document.getElementsByClassName("tab");
    tab[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (tab.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
    }
    // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n)
  }
  
  function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
      //...the form gets submitted:
      document.getElementById("regForm").submit();
        
      return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
  }
  
  function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
      // If a field is empty...
      if (y[i].value == "") {
        // add an "invalid" class to the field:
        y[i].className += " invalid";
        // and set the current valid status to false:
        valid = false;
      }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
      document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
  }
  
  function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";
  }

  
    // become a partner - earnings estimates by city,vehicle type and number of days
    const delivery_location = [{vehicle_type : "Motorcycle", days : [
     {
       week : "1 Week",
       earnings : "GMD 3,000"
     },
     {
       month1 : "1 Month",
       earnings : "GMD 15,000"
     },
     {
       month3 : "3 Months",
       earnings : "GMD 60,000"
     },
     {
       month6 : "6 Months",
       earnings : "GMD 130,000"
     },
     {
       year : "1 Year",
       earnings : "GMD 300,000"
     }
  
   ]
   }];

   const delivery_location1 = [{vehicle_type : "Pickup", days : [
    {
      week : "1 Week",
      earnings : "GMD 6,000"
    },
    {
      month1 : "1 Month",
      earnings : "GMD 30,000"
    },
    {
      month3 : "3 Months",
      earnings : "GMD 120,000"
    },
    {
      month6 : "6 Months",
      earnings : "GMD 300,000"
    },
    {
      year : "1 Year",
      earnings : "GMD 500,000"
    }
 
  ]
  }];

 
  
   $(".estimate_earnings").on('click', () => {
       let location = document.querySelector("#location").value;
       const vehicle_type = document.querySelector("#vehicle_type").value;
       const days = document.querySelector("#days").value;
       
        if((location.localeCompare("Serrekunda") == 0 || location.localeCompare("Banjul") == 0) && ( vehicle_type.localeCompare("Motorcycle") == 0 || vehicle_type.localeCompare("Pickup") == 0) && days.localeCompare("1 Week") == 0) {
          if(vehicle_type.localeCompare("Pickup") == 0) {
            document.querySelector("#earnings_amount").innerHTML = `<span style="margin: 0px 30px; font-size: 30px; font-weight: bold;""> ${ delivery_location1[0].days[0].earnings } </span>`;
          }else {
            document.querySelector("#earnings_amount").innerHTML = `<span style="margin: 0px 30px; font-size: 30px; font-weight: bold;""> ${ delivery_location[0].days[0].earnings } </span>`;
          }
         }else if((location.localeCompare("Serrekunda") == 0 || location.localeCompare("Banjul") == 0) && ( vehicle_type.localeCompare("Motorcycle") == 0 || vehicle_type.localeCompare("Pickup") == 0)  && days.localeCompare("1 Month") == 0) {
          if(vehicle_type.localeCompare("Pickup") == 0) {
            document.querySelector("#earnings_amount").innerHTML = `<span style="margin: 0px 30px; font-size: 30px; font-weight: bold;""> ${ delivery_location1[0].days[1].earnings } </span>`;
          }else {
            document.querySelector("#earnings_amount").innerHTML = `<span style="margin: 0px 30px; font-size: 30px; font-weight: bold;""> ${ delivery_location[0].days[1].earnings } </span>`;
          }
         }else if((location.localeCompare("Serrekunda") == 0 || location.localeCompare("Banjul") == 0) && ( vehicle_type.localeCompare("Motorcycle") == 0 || vehicle_type.localeCompare("Pickup") == 0)  && days.localeCompare("3 Months") == 0) {
          if(vehicle_type.localeCompare("Pickup") == 0) {
            document.querySelector("#earnings_amount").innerHTML = `<span style="margin: 0px 30px; font-size: 30px; font-weight: bold;""> ${ delivery_location1[0].days[2].earnings } </span>`;
          }else {
            document.querySelector("#earnings_amount").innerHTML = `<span style="margin: 0px 30px; font-size: 30px; font-weight: bold;""> ${ delivery_location[0].days[2].earnings } </span>`;
          }
         }else if((location.localeCompare("Serrekunda") == 0 || location.localeCompare("Banjul") == 0) && ( vehicle_type.localeCompare("Motorcycle") == 0 || vehicle_type.localeCompare("Pickup") == 0)  && days.localeCompare("6 Months") == 0) {
            if(vehicle_type.localeCompare("Pickup") == 0) {
              document.querySelector("#earnings_amount").innerHTML = `<span style="margin: 0px 30px; font-size: 30px; font-weight: bold;""> ${ delivery_location1[0].days[3].earnings } </span>`;
            }else {
              document.querySelector("#earnings_amount").innerHTML = `<span style="margin: 0px 30px; font-size: 30px; font-weight: bold;""> ${ delivery_location[0].days[3].earnings } </span>`;
            }
         }else if((location.localeCompare("Serrekunda") == 0 || location.localeCompare("Banjul") == 0) && ( vehicle_type.localeCompare("Motorcycle") == 0 || vehicle_type.localeCompare("Pickup") == 0)  && days.localeCompare("1 Year") == 0) {
                if(vehicle_type.localeCompare("Pickup") == 0) {
                  document.querySelector("#earnings_amount").innerHTML = `<span style="margin: 0px 30px; font-size: 30px; font-weight: bold;""> ${ delivery_location1[0].days[4].earnings } </span>`;
                }else {
                  document.querySelector("#earnings_amount").innerHTML = `<span style="margin: 0px 30px; font-size: 30px; font-weight: bold;""> ${ delivery_location[0].days[4].earnings } </span>`;
                }
         }else {
            document.querySelector("#earnings_amount").innerHTML = "Network Error";
         }
             
      
   });

   // estimates for delivery by location

   const estimates_by_location = [{to: "Serrekunda", from: "Banjul", rate : "GMD 500"},{to:"Serrekunda",from:"Serrekunda", rate: "GMD 150"},{to:"Banjul",from:"Banjul", rate: "GMD 100"}];

   $(".estimate").on('click', () => {
        const pick_up_location = document.querySelector("#pick_up_location").value;
        const delivery_location = document.querySelector("#delivery_location").value;

        if((pick_up_location.localeCompare("Serrekunda") == 0 && delivery_location.localeCompare("Banjul") == 0) || (pick_up_location.localeCompare("Banjul") == 0 && delivery_location.localeCompare("Serrekunda") == 0)) {
          document.querySelector("#delivery_cost").innerHTML = `<span style= "margin: 0px 10px; font-size: 25px; font-weight: bold;"> ${ estimates_by_location[0].rate } </span>`;
        }else if(pick_up_location.localeCompare("Serrekunda") == 0 && delivery_location.localeCompare("Serrekunda") == 0) {
          document.querySelector("#delivery_cost").innerHTML = `<span style="margin: 0px 10px; font-size: 25px; font-weight: bold;"> ${ estimates_by_location[1].rate } </span>`
        }else if(pick_up_location.localeCompare("Banjul") == 0 && delivery_location.localeCompare("Banjul") == 0){
          document.querySelector("#delivery_cost").innerHTML = `<span style="margin: 0px 10px; font-size: 25px; font-weight: bold;"> ${ estimates_by_location[2].rate } </span>`
        }
   });

