<?php
require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Interactive Analytics Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<header class="topbar">
  <div><span class="logo">Y</span><strong>Insight Dashboard</strong></div>
  <span class="status"><i></i> Live overview</span>
</header>
<main class="container">
  <section class="welcome">
    <div><p class="eyebrow">ANALYTICS / OVERVIEW</p><h1>Dashboard Overview</h1>
    <p class="muted">Track income, expenses and monthly activity in one place.</p></div>
    <button id="refreshBtn" class="primary">↻ Refresh data</button>
  </section>

  <section class="filters panel">
    <label>Start date <input type="date" id="startDate"></label>
    <label>End date <input type="date" id="endDate"></label>
    <label>Record type
      <select id="typeFilter"><option value="all">All records</option><option value="income">Income</option><option value="expense">Expense</option></select>
    </label>
    <button id="applyBtn" class="primary">Apply filters</button>
    <button id="clearBtn" class="secondary">Clear</button>
  </section>

  <section class="cards">
    <article class="stat panel"><span class="stat-icon purple">₹</span><p>Total income</p><h2 id="incomeTotal">₹0.00</h2><small>Income in selected period</small></article>
    <article class="stat panel"><span class="stat-icon orange">−</span><p>Total expenses</p><h2 id="expenseTotal">₹0.00</h2><small>Expenses in selected period</small></article>
    <article class="stat panel"><span class="stat-icon green">=</span><p>Net balance</p><h2 id="balanceTotal">₹0.00</h2><small>Income minus expenses</small></article>
    <article class="stat panel"><span class="stat-icon blue">#</span><p>Total records</p><h2 id="recordCount">0</h2><small>Transactions in selected period</small></article>
  </section>

  <section class="chart-grid">
    <article class="panel chart-panel"><div class="panel-heading"><div><h3>Income vs expenses</h3><p class="muted">Monthly comparison</p></div></div><canvas id="monthlyChart"></canvas></article>
    <article class="panel chart-panel"><div class="panel-heading"><div><h3>Record breakdown</h3><p class="muted">Income and expense share</p></div></div><canvas id="typeChart"></canvas></article>
  </section>

  <section class="panel table-panel">
    <div class="panel-heading"><div><h3>Recent transactions</h3><p class="muted">Records matching your filters</p></div><span id="tableStatus" class="muted">Loading…</span></div>
    <div class="table-wrap"><table><thead><tr><th>Date</th><th>Type</th><th>Category</th><th>Description</th><th class="right">Amount</th></tr></thead><tbody id="transactionsBody"><tr><td colspan="5">Loading data…</td></tr></tbody></table></div>
  </section>
  <p id="message" class="message" role="status"></p>
  <footer>Interactive Dashboard · Built with HTML, CSS, JavaScript, PHP and MySQL</footer>
</main>
<script src="script.js"></script>
</body>
</html>
