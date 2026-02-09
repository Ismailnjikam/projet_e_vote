// Chart.js - Results Chart
document.addEventListener('DOMContentLoaded', function() {
    const canvasElement = document.getElementById('resultsChart');
    if (!canvasElement) return;
    
    const ctx = canvasElement.getContext('2d');
    const labels = Array.from(document.querySelectorAll('table tbody tr')).map(row => {
        const nameCell = row.querySelector('td:nth-child(2)');
        return nameCell ? nameCell.textContent.trim().split('\n')[0] : '';
    });
    
    const data = Array.from(document.querySelectorAll('table tbody tr')).map(row => {
        const votesCell = row.querySelector('td:nth-child(3)');
        return votesCell ? parseInt(votesCell.textContent.trim()) : 0;
    });
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nombre de votes',
                data: data,
                backgroundColor: [
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(118, 75, 162, 0.8)',
                    'rgba(102, 126, 234, 0.6)',
                    'rgba(118, 75, 162, 0.6)',
                    'rgba(102, 126, 234, 0.4)',
                ],
                borderColor: [
                    'rgb(102, 126, 234)',
                    'rgb(118, 75, 162)',
                    'rgb(102, 126, 234)',
                    'rgb(118, 75, 162)',
                    'rgb(102, 126, 234)',
                ],
                borderWidth: 2,
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                    }
                },
                x: {
                    grid: {
                        display: false,
                    }
                }
            }
        }
    });
});
