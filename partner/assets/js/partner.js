
// $(document).ready(() => {
//     // graph 
// let  days = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
// let daily_earnings = ["2000","3000","5000","1000","300","400","50"];
  

// let chart = document.querySelector("#daily_earnings");
// new Chart(chart, {
//         type: 'bar',
//         data: {
//               labels: days,
//               datasets: [
//                       { 
//                         data: daily_earnings,
//                         label: "Daily Earnings",
//                         borderColor: "#1b7fc3",
//                         fill: true,

//                       }
//                     ]
//       }
// });
// });

$(document).ready(() => {
  // graph 
  let  days = [];
  let  daily_earnings = [];
    
  $(document).ready(() => {
    $.ajax({url: "graph.php", type: "GET", async : false, dataType: "json", success : (result) => {   
          $.each(result.data, (index, data) => {
            days[index] = data.Day;
            daily_earnings[index] = data.Earnings;
          ;
          })
    }, fail : (jqXHR, textStatus, errorTrown) => {
          console.log("There was an error -> "+textStatus + " : "+ errorTrown);
    }});
  
  let chart = document.querySelector("#daily_earnings");
  new Chart(chart, {
          type: 'bar',
          data: {
                labels: days,
                datasets: [
                        { 
                          data: daily_earnings,
                          label: "Daily Earnings",
                          borderColor: "#1b7fc3",
                          fill: true,
  
                        }
                      ]
        }
  });
  });
  
  });


  $(document).ready(() => {
    $('#arrival_time').datetimepicker();
  });