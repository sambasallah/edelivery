$(document).ready(() => {
  // graph 
  let  days = [];
  let  daily_revenue = [];
    
  $(document).ready(() => {
    $.ajax({url: "graph.php", type: "GET", async : false, dataType: "json", success : (result) => {   
          $.each(result.data, (index, data) => {
            days[index] = data.Day;
            daily_revenue[index] = data.Revenue;
          ;
          })
    }, fail : (jqXHR, textStatus, errorTrown) => {
          console.log("There was an error -> "+textStatus + " : "+ errorTrown);
    }});
  
  let chart = document.querySelector("#admin_analytics");
  new Chart(chart, {
          type: 'bar',
          data: {
                labels: days,
                datasets: [
                        { 
                          data: daily_revenue,
                          label: "Weekly Revenue",
                          borderColor: "#1b7fc3",
                          fill: true,
  
                        }
                      ]
        }
  });
  });
  
  });
