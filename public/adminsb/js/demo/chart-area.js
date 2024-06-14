document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('kamarPieChart').getContext('2d');
    var kamarCountsData = JSON.parse(document.getElementById('kamarCountsData').dataset.counts);
    var kamarLabels = Object.keys(kamarCountsData);
    var kamarData = Object.values(kamarCountsData);
  
  
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: kamarLabels,
            datasets: [{
                data: kamarData,
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b',
                    '#858796', '#f8f9fc', '#5a5c69', '#ff5733', '#c70039',
                    '#900c3f', '#581845', '#ffc300', '#daf7a6', '#ff6384', '#36a2eb'
                ],
                hoverBackgroundColor: [
                    '#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#d92e2e',
                    '#6c757d', '#f1f3f4', '#4e4e50', '#ff6f61', '#d74f45',
                    '#a61d4d', '#6c1e5c', '#ffba42', '#e3f09b', '#ff839a', '#60b9e6'
                ],
                hoverBorderColor: "rgba(234, 236, 244, 1)"
            }],
        },
        options: {
            maintainAspectRatio: true, // Mengatur aspek rasio chart
            layout: {
                padding: { // Menambahkan padding di dalam chart
                    left: 10,
                    right: 10,
                    top: 10,
                    bottom: 10
                }
            },
            title: { // Menambahkan judul chart
                display: true,
                text: 'Jumlah Santri per Kamar',
                fontSize: 16
            },
            legend: { // Mengatur legend chart
                display: true,
                position: 'bottom',
                labels: {
                    fontSize: 12
                }
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            cutoutPercentage: 0,
        },
    });
  });