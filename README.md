# Week 5 — JavaScript-Based Interactive Dashboard

## Features
- Responsive dashboard layout for desktop and mobile
- Summary cards for total income, expenses, balance and record count
- PHP API reads transaction data from MySQL and returns JSON
- JavaScript fetches data without reloading the page
- Interactive monthly bar chart and income/expense doughnut chart using Chart.js
- Date-range and record-type filters
- Recent transaction table and basic error messages

## Run with XAMPP
1. Copy this folder to `C:\xampp\htdocs\week5_interactive_dashboard` (or the `htdocs` folder in your XAMPP installation).
2. Start Apache and MySQL in XAMPP.
3. Open phpMyAdmin and import `database.sql`.
4. If your MySQL credentials differ, update `db.php`.
5. Visit `http://localhost/week5_interactive_dashboard/`.

## GitHub
Create a public repository named `week5-interactive-dashboard`, upload all project files, and paste the repository URL into the internship submission form.

## Notes
The sample records are for demonstration. The dashboard is read-only; filters update the summary, charts and table. Chart.js is loaded from its public CDN, so an internet connection is needed for charts.
