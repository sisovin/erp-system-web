<?php
/**
 * Financial Reports - Generate and view financial statements
 * 
 * Required variables:
 * - $user: Current authenticated user object
 * - $reportData: Report data based on selected report type (optional)
 */

$pageTitle = 'Financial Reports';
$activeMenu = 'accounts';

$reportData = $reportData ?? null;

ob_start();
?>

<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Financial Reports</h1>
    <p class="mt-2 text-gray-600">Generate and view comprehensive financial statements</p>
</div>

<!-- Report Selector Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <button onclick="selectReport('income_statement')" class="report-card bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all text-left group">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <svg class="w-6 h-6 text-gray-400 group-hover:text-primary-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Income Statement</h3>
        <p class="text-sm text-gray-600">Profit & Loss report showing revenue and expenses</p>
    </button>

    <button onclick="selectReport('balance_sheet')" class="report-card bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all text-left group">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-green-100 rounded-lg group-hover:bg-green-200 transition">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                </svg>
            </div>
            <svg class="w-6 h-6 text-gray-400 group-hover:text-primary-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Balance Sheet</h3>
        <p class="text-sm text-gray-600">Assets, Liabilities, and Equity overview</p>
    </button>

    <button onclick="selectReport('cash_flow')" class="report-card bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all text-left group">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-purple-100 rounded-lg group-hover:bg-purple-200 transition">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                </svg>
            </div>
            <svg class="w-6 h-6 text-gray-400 group-hover:text-primary-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Cash Flow Statement</h3>
        <p class="text-sm text-gray-600">Operating, Investing, and Financing activities</p>
    </button>

    <button onclick="selectReport('trial_balance')" class="report-card bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all text-left group">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-yellow-100 rounded-lg group-hover:bg-yellow-200 transition">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <svg class="w-6 h-6 text-gray-400 group-hover:text-primary-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Trial Balance</h3>
        <p class="text-sm text-gray-600">List of all accounts with debit and credit balances</p>
    </button>

    <button onclick="selectReport('aging_report')" class="report-card bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all text-left group">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-red-100 rounded-lg group-hover:bg-red-200 transition">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <svg class="w-6 h-6 text-gray-400 group-hover:text-primary-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Aging Report</h3>
        <p class="text-sm text-gray-600">Accounts receivable/payable aging analysis</p>
    </button>

    <button onclick="selectReport('tax_summary')" class="report-card bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-all text-left group">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-indigo-100 rounded-lg group-hover:bg-indigo-200 transition">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
            </div>
            <svg class="w-6 h-6 text-gray-400 group-hover:text-primary-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Tax Summary</h3>
        <p class="text-sm text-gray-600">Tax collected, paid, and summary by category</p>
    </button>
</div>

<!-- Report Parameters & Display Section -->
<div id="reportSection" class="hidden space-y-6">
    <!-- Report Parameters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Report Parameters</h2>
        <form id="reportParamsForm" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                <input type="date" id="date_from" name="date_from" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            </div>
            <div>
                <label for="date_to" class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                <input type="date" id="date_to" name="date_to" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            </div>
            <div>
                <label for="period" class="block text-sm font-medium text-gray-700 mb-2">Period</label>
                <select id="period" name="period" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="monthly">Monthly</option>
                    <option value="quarterly">Quarterly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>
            <div class="flex items-end">
                <label class="flex items-center">
                    <input type="checkbox" id="show_comparison" name="show_comparison" class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    <span class="ml-2 text-sm font-medium text-gray-700">Show Comparison</span>
                </label>
            </div>
            <div class="md:col-span-2 lg:col-span-4 flex gap-3">
                <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-medium">
                    Generate Report
                </button>
                <button type="button" onclick="exportPDF()" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    Export PDF
                </button>
                <button type="button" onclick="exportExcel()" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export Excel
                </button>
                <button type="button" onclick="printReport()" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-medium flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Print
                </button>
            </div>
        </form>
    </div>

    <!-- Report Display -->
    <div id="reportDisplay" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 print:shadow-none">
        <div class="text-center mb-6 print:mb-8">
            <h2 id="reportTitle" class="text-2xl font-bold text-gray-900 mb-2">Income Statement</h2>
            <p id="reportPeriod" class="text-sm text-gray-600">For the period ending <span id="periodText"></span></p>
            <p class="text-xs text-gray-500 mt-1">Generated on <?php echo date('F j, Y'); ?></p>
        </div>

        <div id="reportContent" class="overflow-x-auto">
            <!-- Report content will be dynamically loaded here -->
            <p class="text-center text-gray-500 py-8">Select report parameters and click "Generate Report" to view</p>
        </div>
    </div>
</div>

<style>
@media print {
    body {
        background: white;
    }
    .report-card, #reportSection > div:first-child, header, nav, button {
        display: none !important;
    }
    #reportDisplay {
        border: none;
        box-shadow: none;
    }
    table {
        page-break-inside: auto;
    }
    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }
}

@media screen {
    .print\\:mb-8 {
        margin-bottom: 0;
    }
}
</style>

<script>
let currentReport = null;

// Set default dates
const today = new Date();
const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
document.getElementById('date_from').valueAsDate = firstDay;
document.getElementById('date_to').valueAsDate = today;

function selectReport(reportType) {
    currentReport = reportType;
    document.getElementById('reportSection').classList.remove('hidden');
    
    const titles = {
        'income_statement': 'Income Statement (Profit & Loss)',
        'balance_sheet': 'Balance Sheet',
        'cash_flow': 'Cash Flow Statement',
        'trial_balance': 'Trial Balance',
        'aging_report': 'Aging Report',
        'tax_summary': 'Tax Summary'
    };
    
    document.getElementById('reportTitle').textContent = titles[reportType] || 'Financial Report';
    document.getElementById('reportContent').innerHTML = '<p class="text-center text-gray-500 py-8">Select report parameters and click "Generate Report" to view</p>';
    
    // Scroll to report section
    document.getElementById('reportSection').scrollIntoView({ behavior: 'smooth' });
}

document.getElementById('reportParamsForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    if (!currentReport) {
        App.Toast.show('Please select a report type first', 'error');
        return;
    }
    
    const formData = new FormData(this);
    const params = {
        report_type: currentReport,
        date_from: formData.get('date_from'),
        date_to: formData.get('date_to'),
        period: formData.get('period'),
        show_comparison: formData.get('show_comparison') ? 1 : 0
    };
    
    try {
        const response = await App.API.post('/accounts/reports/generate', params);
        
        if (response.success) {
            document.getElementById('periodText').textContent = formData.get('date_to');
            displayReport(currentReport, response.data);
        } else {
            App.Toast.show(response.message || 'Failed to generate report', 'error');
        }
    } catch (error) {
        console.error('Error generating report:', error);
        App.Toast.show('An error occurred while generating the report', 'error');
    }
});

function displayReport(reportType, data) {
    const content = document.getElementById('reportContent');
    
    switch(reportType) {
        case 'income_statement':
            content.innerHTML = generateIncomeStatementHTML(data);
            break;
        case 'balance_sheet':
            content.innerHTML = generateBalanceSheetHTML(data);
            break;
        case 'cash_flow':
            content.innerHTML = generateCashFlowHTML(data);
            break;
        case 'trial_balance':
            content.innerHTML = generateTrialBalanceHTML(data);
            break;
        case 'aging_report':
            content.innerHTML = generateAgingReportHTML(data);
            break;
        case 'tax_summary':
            content.innerHTML = generateTaxSummaryHTML(data);
            break;
        default:
            content.innerHTML = '<p class="text-center text-gray-500 py-8">Report type not supported</p>';
    }
}

function generateIncomeStatementHTML(data) {
    // Sample structure - adapt based on your data
    return `
        <table class="w-full">
            <thead>
                <tr class="border-b-2 border-gray-300">
                    <th class="text-left py-2 font-bold">Account</th>
                    <th class="text-right py-2 font-bold">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-gray-50">
                    <td colspan="2" class="py-2 px-4 font-bold">REVENUE</td>
                </tr>
                ${(data.revenue || []).map(item => `
                    <tr>
                        <td class="py-1 px-8">${item.name}</td>
                        <td class="text-right py-1">$${formatNumber(item.amount)}</td>
                    </tr>
                `).join('')}
                <tr class="border-t border-gray-300 font-semibold">
                    <td class="py-2 px-4">Total Revenue</td>
                    <td class="text-right py-2">$${formatNumber(data.total_revenue || 0)}</td>
                </tr>
                <tr class="bg-gray-50">
                    <td colspan="2" class="py-2 px-4 font-bold">EXPENSES</td>
                </tr>
                ${(data.expenses || []).map(item => `
                    <tr>
                        <td class="py-1 px-8">${item.name}</td>
                        <td class="text-right py-1">${item.amount < 0 ? '(' : ''}$${formatNumber(Math.abs(item.amount))}${item.amount < 0 ? ')' : ''}</td>
                    </tr>
                `).join('')}
                <tr class="border-t border-gray-300 font-semibold">
                    <td class="py-2 px-4">Total Expenses</td>
                    <td class="text-right py-2">${data.total_expenses < 0 ? '(' : ''}$${formatNumber(Math.abs(data.total_expenses || 0))}${data.total_expenses < 0 ? ')' : ''}</td>
                </tr>
                <tr class="border-t-2 border-gray-900 font-bold text-lg">
                    <td class="py-3 px-4">NET INCOME</td>
                    <td class="text-right py-3">${data.net_income < 0 ? '(' : ''}$${formatNumber(Math.abs(data.net_income || 0))}${data.net_income < 0 ? ')' : ''}</td>
                </tr>
            </tbody>
        </table>
    `;
}

function generateBalanceSheetHTML(data) {
    return `
        <table class="w-full">
            <thead>
                <tr class="border-b-2 border-gray-300">
                    <th class="text-left py-2 font-bold">Account</th>
                    <th class="text-right py-2 font-bold">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-gray-50">
                    <td colspan="2" class="py-2 px-4 font-bold">ASSETS</td>
                </tr>
                ${(data.assets || []).map(item => `
                    <tr>
                        <td class="py-1 px-8">${item.name}</td>
                        <td class="text-right py-1">$${formatNumber(item.amount)}</td>
                    </tr>
                `).join('')}
                <tr class="border-t border-gray-300 font-semibold">
                    <td class="py-2 px-4">Total Assets</td>
                    <td class="text-right py-2">$${formatNumber(data.total_assets || 0)}</td>
                </tr>
                <tr class="bg-gray-50">
                    <td colspan="2" class="py-2 px-4 font-bold">LIABILITIES</td>
                </tr>
                ${(data.liabilities || []).map(item => `
                    <tr>
                        <td class="py-1 px-8">${item.name}</td>
                        <td class="text-right py-1">$${formatNumber(item.amount)}</td>
                    </tr>
                `).join('')}
                <tr class="border-t border-gray-300 font-semibold">
                    <td class="py-2 px-4">Total Liabilities</td>
                    <td class="text-right py-2">$${formatNumber(data.total_liabilities || 0)}</td>
                </tr>
                <tr class="bg-gray-50">
                    <td colspan="2" class="py-2 px-4 font-bold">EQUITY</td>
                </tr>
                ${(data.equity || []).map(item => `
                    <tr>
                        <td class="py-1 px-8">${item.name}</td>
                        <td class="text-right py-1">$${formatNumber(item.amount)}</td>
                    </tr>
                `).join('')}
                <tr class="border-t border-gray-300 font-semibold">
                    <td class="py-2 px-4">Total Equity</td>
                    <td class="text-right py-2">$${formatNumber(data.total_equity || 0)}</td>
                </tr>
                <tr class="border-t-2 border-gray-900 font-bold text-lg">
                    <td class="py-3 px-4">TOTAL LIABILITIES & EQUITY</td>
                    <td class="text-right py-3">$${formatNumber((data.total_liabilities || 0) + (data.total_equity || 0))}</td>
                </tr>
            </tbody>
        </table>
    `;
}

function generateCashFlowHTML(data) {
    return `<p class="text-center text-gray-500 py-8">Cash Flow Statement - Implementation pending</p>`;
}

function generateTrialBalanceHTML(data) {
    return `<p class="text-center text-gray-500 py-8">Trial Balance - Implementation pending</p>`;
}

function generateAgingReportHTML(data) {
    return `<p class="text-center text-gray-500 py-8">Aging Report - Implementation pending</p>`;
}

function generateTaxSummaryHTML(data) {
    return `<p class="text-center text-gray-500 py-8">Tax Summary - Implementation pending</p>`;
}

function formatNumber(num) {
    return parseFloat(num).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

function exportPDF() {
    if (!currentReport) {
        App.Toast.show('Please generate a report first', 'error');
        return;
    }
    window.location.href = `/accounts/reports/export/pdf?type=${currentReport}&date_from=${document.getElementById('date_from').value}&date_to=${document.getElementById('date_to').value}`;
}

function exportExcel() {
    if (!currentReport) {
        App.Toast.show('Please generate a report first', 'error');
        return;
    }
    window.location.href = `/accounts/reports/export/excel?type=${currentReport}&date_from=${document.getElementById('date_from').value}&date_to=${document.getElementById('date_to').value}`;
}

function printReport() {
    if (!currentReport) {
        App.Toast.show('Please generate a report first', 'error');
        return;
    }
    window.print();
}
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout/user_layout.php';
?>
