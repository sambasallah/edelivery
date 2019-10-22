
$(document).ready(() => {
    // graph 
let  days = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
let daily_earnings = ["2000","3000","5000","1000","300","400","50"];
  

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

