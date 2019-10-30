
$(document).ready(() => {
    // graph 
let  days = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
let weekly_revenue = ["30000","40000","500000","80000","20000","100000","50000"];
  

let chart = document.querySelector("#admin_analytics");
new Chart(chart, {
        type: 'line',
        data: {
              labels: days,
              datasets: [
                      { 
                        data: weekly_revenue,
                        label: "Weekly Revenue",
                        borderColor: "#1b7fc3",
                        fill: true,

                      }
                    ]
      }
});
});