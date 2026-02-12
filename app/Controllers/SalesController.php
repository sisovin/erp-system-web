<?php
/**
 * SalesController
 * 
 * Handles sales operations including orders,
 * invoices, and customer management
 */

require_once __DIR__ . '/../Services/Database.php';

class SalesController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }

    /**
     * Display list of sales orders
     */
    public function index($user)
    {
        $stmt = $this->pdo->query("
            SELECT so.*, c.name as customer_name 
            FROM sales_orders so 
            LEFT JOIN customers c ON so.customer_id = c.id 
            ORDER BY so.created_at DESC
        ");
        $orders = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/sales/index.php';
    }

    /**
     * Show create order form
     */
    public function create($user)
    {
        // Get customers
        $stmt = $this->pdo->query("SELECT * FROM customers ORDER BY name ASC");
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);

        // Get products
        $stmt = $this->pdo->query("SELECT * FROM products WHERE stock > 0 ORDER BY name ASC");
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/sales/create.php';
    }

    /**
     * Store new sales order
     */
    public function store()
    {
        $customer_id = $_POST['customer_id'] ?? 0;
        $total = $_POST['total'] ?? 0;
        $status = $_POST['status'] ?? 'pending';

        $this->pdo->beginTransaction();
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO sales_orders (customer_id, total, status, created_at) 
                VALUES (?, ?, ?, NOW())
            ");
            $stmt->execute([$customer_id, $total, $status]);
            $order_id = $this->pdo->lastInsertId();

            // Insert order items (if provided)
            if (!empty($_POST['items'])) {
                $stmt = $this->pdo->prepare("
                    INSERT INTO sales_items (order_id, product_id, quantity, price, created_at) 
                    VALUES (?, ?, ?, ?, NOW())
                ");
                foreach ($_POST['items'] as $item) {
                    $stmt->execute([
                        $order_id,
                        $item['product_id'],
                        $item['quantity'],
                        $item['price']
                    ]);
                }
            }

            $this->pdo->commit();
            $_SESSION['flash_success'] = 'Sales order created successfully';
            header('Location: /sales');
            exit;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            $_SESSION['flash_error'] = 'Failed to create order: ' . $e->getMessage();
            header('Location: /sales/create');
            exit;
        }
    }

    /**
     * Show order details
     */
    public function show($id, $user)
    {
        $stmt = $this->pdo->prepare("
            SELECT so.*, c.name as customer_name, c.email as customer_email 
            FROM sales_orders so 
            LEFT JOIN customers c ON so.customer_id = c.id 
            WHERE so.id = ?
        ");
        $stmt->execute([$id]);
        $order = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$order) {
            $_SESSION['flash_error'] = 'Order not found';
            header('Location: /sales');
            exit;
        }

        // Get order items
        $stmt = $this->pdo->prepare("
            SELECT si.*, p.name as product_name, p.sku 
            FROM sales_items si 
            JOIN products p ON si.product_id = p.id 
            WHERE si.order_id = ?
        ");
        $stmt->execute([$id]);
        $items = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/sales/show.php';
    }

    /**
     * Update order status
     */
    public function updateStatus($id)
    {
        $status = $_POST['status'] ?? '';

        $stmt = $this->pdo->prepare("
            UPDATE sales_orders 
            SET status = ?, updated_at = NOW() 
            WHERE id = ?
        ");
        $stmt->execute([$status, $id]);

        $_SESSION['flash_success'] = 'Order status updated successfully';
        header('Location: /sales/' . $id);
        exit;
    }

    /**
     * Customers management
     */
    public function customers($user)
    {
        $stmt = $this->pdo->query("
            SELECT * FROM customers 
            ORDER BY created_at DESC
        ");
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/sales/customers.php';
    }

    /**
     * Invoices management
     */
    public function invoices($user)
    {
        $stmt = $this->pdo->query("
            SELECT i.*, so.total, c.name as customer_name 
            FROM invoices i 
            JOIN sales_orders so ON i.order_id = so.id 
            LEFT JOIN customers c ON so.customer_id = c.id 
            ORDER BY i.created_at DESC
        ");
        $invoices = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/sales/invoices.php';
    }

    /**
     * Generate invoice for order
     */
    public function generateInvoice($orderId)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO invoices (order_id, status, created_at) 
            VALUES (?, 'pending', NOW())
        ");
        $stmt->execute([$orderId]);

        $_SESSION['flash_success'] = 'Invoice generated successfully';
        header('Location: /sales/' . $orderId);
        exit;
    }
}
