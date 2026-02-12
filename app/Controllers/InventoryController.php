<?php
/**
 * InventoryController
 * 
 * Handles inventory management including products,
 * stock movements, and suppliers
 */

require_once __DIR__ . '/../Services/Database.php';

class InventoryController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }

    /**
     * Display list of products
     */
    public function index($user)
    {
        $stmt = $this->pdo->query("
            SELECT * FROM products 
            ORDER BY created_at DESC
        ");
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/inventory/index.php';
    }

    /**
     * Show create product form
     */
    public function create($user)
    {
        require __DIR__ . '/../../resources/views/inventory/create.php';
    }

    /**
     * Store new product
     */
    public function store()
    {
        $sku = $_POST['sku'] ?? '';
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = $_POST['price'] ?? 0;
        $stock = $_POST['stock'] ?? 0;
        $category = $_POST['category'] ?? '';

        $stmt = $this->pdo->prepare("
            INSERT INTO products (sku, name, description, price, stock, category, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([$sku, $name, $description, $price, $stock, $category]);

        $_SESSION['flash_success'] = 'Product created successfully';
        header('Location: /inventory');
        exit;
    }

    /**
     * Show product details
     */
    public function show($id, $user)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$product) {
            $_SESSION['flash_error'] = 'Product not found';
            header('Location: /inventory');
            exit;
        }

        // Get stock movements
        $stmt = $this->pdo->prepare("
            SELECT * FROM stock_movements 
            WHERE product_id = ? 
            ORDER BY created_at DESC 
            LIMIT 20
        ");
        $stmt->execute([$id]);
        $movements = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/inventory/show.php';
    }

    /**
     * Show edit form
     */
    public function edit($id, $user)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$product) {
            $_SESSION['flash_error'] = 'Product not found';
            header('Location: /inventory');
            exit;
        }

        require __DIR__ . '/../../resources/views/inventory/edit.php';
    }

    /**
     * Update product
     */
    public function update($id)
    {
        $sku = $_POST['sku'] ?? '';
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = $_POST['price'] ?? 0;
        $stock = $_POST['stock'] ?? 0;
        $category = $_POST['category'] ?? '';

        $stmt = $this->pdo->prepare("
            UPDATE products 
            SET sku = ?, name = ?, description = ?, price = ?, stock = ?, category = ?, updated_at = NOW() 
            WHERE id = ?
        ");
        $stmt->execute([$sku, $name, $description, $price, $stock, $category, $id]);

        $_SESSION['flash_success'] = 'Product updated successfully';
        header('Location: /inventory');
        exit;
    }

    /**
     * Delete product
     */
    public function destroy($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);

        $_SESSION['flash_success'] = 'Product deleted successfully';
        header('Location: /inventory');
        exit;
    }

    /**
     * Stock movements
     */
    public function movements($user)
    {
        $stmt = $this->pdo->query("
            SELECT sm.*, p.name as product_name, p.sku 
            FROM stock_movements sm 
            JOIN products p ON sm.product_id = p.id 
            ORDER BY sm.created_at DESC 
            LIMIT 100
        ");
        $movements = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/inventory/movements.php';
    }

    /**
     * Suppliers management
     */
    public function suppliers($user)
    {
        $stmt = $this->pdo->query("
            SELECT * FROM suppliers 
            ORDER BY name ASC
        ");
        $suppliers = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/inventory/suppliers.php';
    }

    /**
     * Low stock alert
     */
    public function lowStock($user)
    {
        $stmt = $this->pdo->query("
            SELECT * FROM products 
            WHERE stock < 10 
            ORDER BY stock ASC
        ");
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/inventory/low_stock.php';
    }
}
