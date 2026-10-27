let monthlyChart, typeChart;

const money = value => new Intl.NumberFormat('en-IN', {
  style: 'currency', currency: 'INR', maximumFractionDigits: 2
}).format(Number(value || 0));

async function loadDashboard() {
  const params = new URLSearchParams();
  const start = document.getElementById('startDate').value;
  const end = document.getElementById('endDate').value;
  const type = document.getElementById('typeFilter').value;
  if (start) params.set('start', start);
  if (end) params.set('end', end);
  if (type) params.set('type', type);

  const message = document.getElementById('message');
  message.textContent = 'Loading dashboard data…';
  try {
    const response = await fetch('api.php?' + params.toString(), { headers: { 'Accept': 'application/json' } });
    if (!response.ok) throw new Error('Server returned an error.');
    const data = await response.json();
    if (!data.success) throw new Error(data.message || 'Unable to load data.');

    document.getElementById('incomeTotal').textContent = money(data.summary.income);
    document.getElementById('expenseTotal').textContent = money(data.summary.expense);
    document.getElementById('balanceTotal').textContent = money(data.summary.balance);
    document.getElementById('recordCount').textContent = data.summary.count;
    document.getElementById('tableStatus').textContent = `${data.transactions.length} record(s)`;

    const body = document.getElementById('transactionsBody');
    body.innerHTML = '';
    if (!data.transactions.length) {
      body.innerHTML = '<tr><td colspan="5" class="empty">No transactions found for these filters.</td></tr>';
    } else {
      data.transactions.forEach(row => {
        const tr = document.createElement('tr');
        const date = document.createElement('td'); date.textContent = row.transaction_date;
        const typeCell = document.createElement('td');
        const badge = document.createElement('span'); badge.className = 'badge ' + row.type; badge.textContent = row.type;
        typeCell.appendChild(badge);
        const category = document.createElement('td'); category.textContent = row.category;
        const description = document.createElement('td'); description.textContent = row.description || '—';
        const amount = document.createElement('td'); amount.className = 'right'; amount.textContent = money(row.amount);
        tr.append(date, typeCell, category, description, amount); body.appendChild(tr);
      });
    }
    drawCharts(data.monthly, data.summary);
    message.textContent = '';
  } catch (error) {
    message.textContent = error.message + ' Make sure Apache and MySQL are running and database.sql is imported.';
  }
}

function drawCharts(monthly, summary) {
  const labels = Object.keys(monthly);
  if (monthlyChart) monthlyChart.destroy();
  monthlyChart = new Chart(document.getElementById('monthlyChart'), {
    type: 'bar',
    data: { labels: labels.length ? labels : ['No data'], datasets: [
      { label: 'Income', data: labels.map(m => monthly[m].income), borderWidth: 1 },
      { label: 'Expenses', data: labels.map(m => monthly[m].expense), borderWidth: 1 }
    ]},
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } },
      scales: { y: { beginAtZero: true, ticks: { callback: value => '₹' + value } } } }
  });
  if (typeChart) typeChart.destroy();
  typeChart = new Chart(document.getElementById('typeChart'), {
    type: 'doughnut',
    data: { labels: ['Income', 'Expenses'], datasets: [{ data: [summary.income, summary.expense] }] },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
  });
}

document.getElementById('applyBtn').addEventListener('click', loadDashboard);
document.getElementById('refreshBtn').addEventListener('click', loadDashboard);
document.getElementById('clearBtn').addEventListener('click', () => {
  document.getElementById('startDate').value = '';
  document.getElementById('endDate').value = '';
  document.getElementById('typeFilter').value = 'all';
  loadDashboard();
});
loadDashboard();
