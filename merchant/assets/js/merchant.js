$(document).ready(() => {
// graph 
let  days = [];
let delivery_requests = [];
  
$(document).ready(() => {
  $.ajax({url: "graph.php", type: "GET", async : false, dataType: "json", success : (result) => {   
        $.each(result.data, (index, data) => {
          days[index] = data.Day;
          delivery_requests[index] = data.Request;
        ;
        })
  }, fail : (jqXHR, textStatus, errorTrown) => {
        console.log("There was an error -> "+textStatus + " : "+ errorTrown);
  }});

let chart = document.querySelector("#spendings_chart");
new Chart(chart, {
        type: 'line',
        data: {
              labels: days,
              datasets: [
                      { 
                        data: delivery_requests,
                        label: "Delivery Request",
                        borderColor: "#1b7fc3",
                        fill: true,

                      }
                    ]
      }
});
});

});

$(document).ready(() => {
  $('#pick').datetimepicker();
});