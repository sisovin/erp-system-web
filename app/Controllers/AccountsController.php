<?php
/**
 * AccountsController
 * 
 * Handles accounting operations including chart of accounts,
 * ledger entries, and expenses
 */

require_once __DIR__ . '/../Services/Database.php';

class AccountsController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }

    /**
     * Display chart of accounts
     */
    public function index($user)
    {
        $stmt = $this->pdo->query("
            SELECT * FROM accounts 
            ORDER BY code ASC
        ");
        $accounts = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/accounts/index.php';
    }

    /**
     * Show create account form
     */
    public function create($user)
    {
        require __DIR__ . '/../../resources/views/accounts/create.php';
    }

    /**
     * Store new account
     */
    public function store()
    {
        $code = $_POST['code'] ?? '';
        $name = $_POST['name'] ?? '';
        $type = $_POST['type'] ?? '';

        $stmt = $this->pdo->prepare("
            INSERT INTO accounts (code, name, type, created_at) 
            VALUES (?, ?, ?, NOW())
        ");
        $stmt->execute([$code, $name, $type]);

        $_SESSION['flash_success'] = 'Account created successfully';
        header('Location: /accounts');
        exit;
    }

    /**
     * Show account details with ledger entries
     */
    public function show($id, $user)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM accounts WHERE id = ?");
        $stmt->execute([$id]);
        $account = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$account) {
            $_SESSION['flash_error'] = 'Account not found';
            header('Location: /accounts');
            exit;
        }

        // Get ledger entries
        $stmt = $this->pdo->prepare("
            SELECT * FROM ledger_entries 
            WHERE account_id = ? 
            ORDER BY transaction_date DESC 
            LIMIT 50
        ");
        $stmt->execute([$id]);
        $entries = $stmt->fetchAll(PDO::FETCH_OBJ);

        // Calculate balance
        $stmt = $this->pdo->prepare("
            SELECT 
                SUM(CASE WHEN type = 'debit' THEN amount ELSE 0 END) as total_debit,
                SUM(CASE WHEN type = 'credit' THEN amount ELSE 0 END) as total_credit
            FROM ledger_entries 
            WHERE account_id = ?
        ");
        $stmt->execute([$id]);
        $balance = $stmt->fetch(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/accounts/show.php';
    }

    /**
     * Ledger entries
     */
    public function ledger($user)
    {
        $stmt = $this->pdo->query("
            SELECT le.*, a.code as account_code, a.name as account_name 
            FROM ledger_entries le 
            JOIN accounts a ON le.account_id = a.id 
            ORDER BY le.transaction_date DESC 
            LIMIT 100
        ");
        $entries = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/accounts/ledger.php';
    }

    /**
     * Create ledger entry
     */
    public function createEntry($user)
    {
        $stmt = $this->pdo->query("SELECT * FROM accounts ORDER BY code ASC");
        $accounts = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/accounts/create_entry.php';
    }

    /**
     * Store ledger entry
     */
    public function storeEntry()
    {
        $account_id = $_POST['account_id'] ?? 0;
        $type = $_POST['type'] ?? 'debit';
        $amount = $_POST['amount'] ?? 0;
        $description = $_POST['description'] ?? '';
        $transaction_date = $_POST['transaction_date'] ?? date('Y-m-d');

        $stmt = $this->pdo->prepare("
            INSERT INTO ledger_entries (account_id, type, amount, description, transaction_date, created_at) 
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([$account_id, $type, $amount, $description, $transaction_date]);

        $_SESSION['flash_success'] = 'Ledger entry created successfully';
        header('Location: /accounts/ledger');
        exit;
    }

    /**
     * Expenses management
     */
    public function expenses($user)
    {
        $stmt = $this->pdo->query("
            SELECT e.*, a.code as account_code, a.name as account_name 
            FROM expenses e 
            LEFT JOIN accounts a ON e.account_id = a.id 
            ORDER BY e.date DESC 
            LIMIT 100
        ");
        $expenses = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/accounts/expenses.php';
    }

    /**
     * Create expense
     */
    public function createExpense($user)
    {
        $stmt = $this->pdo->query("SELECT * FROM accounts WHERE type = 'expense' ORDER BY code ASC");
        $accounts = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/accounts/create_expense.php';
    }

    /**
     * Store expense
     */
    public function storeExpense()
    {
        $account_id = $_POST['account_id'] ?? 0;
        $amount = $_POST['amount'] ?? 0;
        $description = $_POST['description'] ?? '';
        $date = $_POST['date'] ?? date('Y-m-d');
        $category = $_POST['category'] ?? '';

        $stmt = $this->pdo->prepare("
            INSERT INTO expenses (account_id, amount, description, date, category, created_at) 
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([$account_id, $amount, $description, $date, $category]);

        $_SESSION['flash_success'] = 'Expense recorded successfully';
        header('Location: /accounts/expenses');
        exit;
    }

    /**
     * Financial reports
     */
    public function reports($user)
    {
        // Income Statement
        $stmt = $this->pdo->query("
            SELECT 
                a.type,
                SUM(le.amount) as total
            FROM ledger_entries le
            JOIN accounts a ON le.account_id = a.id
            WHERE a.type IN ('revenue', 'expense')
            GROUP BY a.type
        ");
        $incomeStatement = $stmt->fetchAll(PDO::FETCH_OBJ);

        // Balance Sheet
        $stmt = $this->pdo->query("
            SELECT 
                a.type,
                SUM(CASE WHEN le.type = 'debit' THEN le.amount ELSE -le.amount END) as balance
            FROM ledger_entries le
            JOIN accounts a ON le.account_id = a.id
            WHERE a.type IN ('asset', 'liability', 'equity')
            GROUP BY a.type
        ");
        $balanceSheet = $stmt->fetchAll(PDO::FETCH_OBJ);

        require __DIR__ . '/../../resources/views/accounts/reports.php';
    }
}
