<?php
/**
 * HRController
 * 
 * Handles HR module operations including employee management,
 * attendance tracking, and payroll processing
 */

require_once __DIR__ . '/../Services/Database.php';

class HRController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }

    /**
     * Display list of employees
     */
    public function index($user)
    {
        $stmt = $this->pdo->query("
            SELECT e.*, u.name as user_name, u.email 
            FROM employees e 
            LEFT JOIN users u ON e.user_id = u.id 
            ORDER BY e.created_at DESC
        ");
        $employees = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/hr/index.php';
    }

    /**
     * Show create employee form
     */
    public function create($user)
    {
        require __DIR__ . '/../../resources/views/hr/create.php';
    }

    /**
     * Store new employee
     */
    public function store()
    {
        $name = $_POST['name'] ?? '';
        $position = $_POST['position'] ?? '';
        $department = $_POST['department'] ?? '';
        $salary = $_POST['salary'] ?? 0;
        $status = $_POST['status'] ?? 'active';

        $stmt = $this->pdo->prepare("
            INSERT INTO employees (name, position, department, salary, status, created_at) 
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([$name, $position, $department, $salary, $status]);

        $_SESSION['flash_success'] = 'Employee created successfully';
        header('Location: /hr');
        exit;
    }

    /**
     * Show employee details
     */
    public function show($id, $user)
    {
        $stmt = $this->pdo->prepare("
            SELECT e.*, u.name as user_name, u.email 
            FROM employees e 
            LEFT JOIN users u ON e.user_id = u.id 
            WHERE e.id = ?
        ");
        $stmt->execute([$id]);
        $employee = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$employee) {
            $_SESSION['flash_error'] = 'Employee not found';
            header('Location: /hr');
            exit;
        }

        require __DIR__ . '/../../resources/views/hr/show.php';
    }

    /**
     * Show edit form
     */
    public function edit($id, $user)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM employees WHERE id = ?");
        $stmt->execute([$id]);
        $employee = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$employee) {
            $_SESSION['flash_error'] = 'Employee not found';
            header('Location: /hr');
            exit;
        }

        require __DIR__ . '/../../resources/views/hr/edit.php';
    }

    /**
     * Update employee
     */
    public function update($id)
    {
        $name = $_POST['name'] ?? '';
        $position = $_POST['position'] ?? '';
        $department = $_POST['department'] ?? '';
        $salary = $_POST['salary'] ?? 0;
        $status = $_POST['status'] ?? 'active';

        $stmt = $this->pdo->prepare("
            UPDATE employees 
            SET name = ?, position = ?, department = ?, salary = ?, status = ?, updated_at = NOW() 
            WHERE id = ?
        ");
        $stmt->execute([$name, $position, $department, $salary, $status, $id]);

        $_SESSION['flash_success'] = 'Employee updated successfully';
        header('Location: /hr');
        exit;
    }

    /**
     * Delete employee
     */
    public function destroy($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM employees WHERE id = ?");
        $stmt->execute([$id]);

        $_SESSION['flash_success'] = 'Employee deleted successfully';
        header('Location: /hr');
        exit;
    }

    /**
     * Attendance management
     */
    public function attendance($user)
    {
        $stmt = $this->pdo->query("
            SELECT a.*, e.name as employee_name 
            FROM attendance a 
            JOIN employees e ON a.employee_id = e.id 
            ORDER BY a.date DESC 
            LIMIT 50
        ");
        $attendance = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/hr/attendance.php';
    }

    /**
     * Payroll management
     */
    public function payroll($user)
    {
        $stmt = $this->pdo->query("
            SELECT p.*, e.name as employee_name 
            FROM payroll p 
            JOIN employees e ON p.employee_id = e.id 
            ORDER BY p.period DESC 
            LIMIT 50
        ");
        $payroll = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/hr/payroll.php';
    }
}
