<?php
/**
 * DashboardController
 * 
 * Handles dashboard data aggregation and metrics calculation
 */

require_once __DIR__ . '/../Services/Database.php';

class DashboardController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }

    /**
     * Display the dashboard with metrics
     */
    public function index($user)
    {
        $metrics = $this->getMetrics();
        
        require __DIR__ . '/../../resources/views/dashboard/index.php';
    }

    /**
     * Get all dashboard metrics
     */
    private function getMetrics(): array
    {
        return [
            'employees' => $this->getEmployeeMetrics(),
            'products' => $this->getProductMetrics(),
            'customers' => $this->getCustomerMetrics(),
            'sales' => $this->getSalesMetrics(),
            'revenue' => $this->getRevenueMetrics(),
            'expenses' => $this->getExpenseMetrics(),
            'profit' => $this->getProfitMetrics()
        ];
    }

    /**
     * Get employee metrics
     */
    private function getEmployeeMetrics(): array
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM employees");
        $total = $stmt->fetchColumn();

        $stmt = $this->pdo->query("SELECT COUNT(*) as active FROM employees WHERE status = 'active'");
        $active = $stmt->fetchColumn();

        return [
            'total' => (int)$total,
            'active' => (int)$active
        ];
    }

    /**
     * Get product metrics
     */
    private function getProductMetrics(): array
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM products");
        $total = $stmt->fetchColumn();

        $stmt = $this->pdo->query("SELECT COUNT(*) as low_stock FROM products WHERE stock < 10");
        $lowStock = $stmt->fetchColumn();

        return [
            'total' => (int)$total,
            'low_stock' => (int)$lowStock
        ];
    }

    /**
     * Get customer metrics
     */
    private function getCustomerMetrics(): array
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM customers");
        $total = $stmt->fetchColumn();

        return [
            'total' => (int)$total
        ];
    }

    /**
     * Get sales metrics
     */
    private function getSalesMetrics(): array
    {
        // Monthly sales count
        $stmt = $this->pdo->query("
            SELECT COUNT(*) as monthly 
            FROM sales_orders 
            WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) 
            AND YEAR(created_at) = YEAR(CURRENT_DATE())
        ");
        $monthly = $stmt->fetchColumn();

        // Pending sales
        $stmt = $this->pdo->query("SELECT COUNT(*) as pending FROM sales_orders WHERE status = 'pending'");
        $pending = $stmt->fetchColumn();

        return [
            'monthly' => (int)$monthly,
            'pending' => (int)$pending
        ];
    }

    /**
     * Get revenue metrics
     */
    private function getRevenueMetrics(): array
    {
        $stmt = $this->pdo->query("
            SELECT COALESCE(SUM(total), 0) as monthly 
            FROM sales_orders 
            WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) 
            AND YEAR(created_at) = YEAR(CURRENT_DATE())
        ");
        $monthly = $stmt->fetchColumn();

        return [
            'monthly' => (float)$monthly
        ];
    }

    /**
     * Get expense metrics
     */
    private function getExpenseMetrics(): array
    {
        $stmt = $this->pdo->query("
            SELECT COALESCE(SUM(amount), 0) as monthly 
            FROM expenses 
            WHERE MONTH(date) = MONTH(CURRENT_DATE()) 
            AND YEAR(date) = YEAR(CURRENT_DATE())
        ");
        $monthly = $stmt->fetchColumn();

        return [
            'monthly' => (float)$monthly
        ];
    }

    /**
     * Get profit metrics
     */
    private function getProfitMetrics(): array
    {
        $revenue = $this->getRevenueMetrics()['monthly'];
        $expenses = $this->getExpenseMetrics()['monthly'];

        return [
            'monthly' => $revenue - $expenses
        ];
    }

    /**
     * Get dashboard metrics as JSON for API
     */
    public function getMetricsJson()
    {
        header('Content-Type: application/json');
        echo json_encode($this->getMetrics());
    }
}
