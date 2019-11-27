
$(document).ready(() => {
    // graph 
let  days = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
let delivery_requests = ["12","20","60","8","200","100","50"];
  

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


