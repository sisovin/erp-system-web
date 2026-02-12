<?php
$title = 'Create Sales Order';
$currentPage = 'sales';
ob_start();
?>

<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Create Sales Order</h1>
            <p class="text-gray-600">Create a new sales order</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="/sales" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Sales
            </a>
        </div>
    </div>

    <!-- Create Form -->
    <div class="bg-white rounded-lg shadow-md">
        <form id="salesOrderForm" class="p-6">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
            
            <!-- Customer Information Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Customer Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Customer Selection -->
                    <div class="md:col-span-2">
                        <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Customer <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-2">
                            <select id="customer_id" name="customer_id" required
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option value="">Select Customer</option>
                                <option value="1">Acme Corporation</option>
                                <option value="2">TechStart Inc.</option>
                                <option value="3">Global Solutions Ltd.</option>
                                <option value="4">Innovation Partners</option>
                            </select>
                            <button type="button" id="addCustomerBtn" 
                                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors whitespace-nowrap">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </button>
                        </div>
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>

                    <!-- Customer Details Display -->
                    <div id="customerDetails" class="md:col-span-2 p-4 bg-gray-50 rounded-lg hidden">
                        <h3 class="text-sm font-medium text-gray-700 mb-3">Contact Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            <div>
                                <p class="text-gray-500">Email</p>
                                <p id="customerEmail" class="font-medium text-gray-900">-</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Phone</p>
                                <p id="customerPhone" class="font-medium text-gray-900">-</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Company</p>
                                <p id="customerCompany" class="font-medium text-gray-900">-</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Details Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Order Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Order Date -->
                    <div>
                        <label for="order_date" class="block text-sm font-medium text-gray-700 mb-2">
                            Order Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="order_date" name="order_date" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>

                    <!-- Due Date -->
                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">
                            Due Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="due_date" name="due_date" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>

                    <!-- Payment Terms -->
                    <div>
                        <label for="payment_terms" class="block text-sm font-medium text-gray-700 mb-2">
                            Payment Terms <span class="text-red-500">*</span>
                        </label>
                        <select id="payment_terms" name="payment_terms" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Select Terms</option>
                            <option value="net_15">Net 15</option>
                            <option value="net_30">Net 30</option>
                            <option value="net_45">Net 45</option>
                            <option value="net_60">Net 60</option>
                            <option value="due_on_receipt">Due on Receipt</option>
                            <option value="cash">Cash</option>
                        </select>
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status" name="status" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="processing">Processing</option>
                            <option value="shipped">Shipped</option>
                            <option value="completed">Completed</option>
                        </select>
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>
                </div>
            </div>

            <!-- Order Items Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4 pb-2 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">Order Items</h2>
                    <button type="button" id="addItemBtn" 
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors text-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Add Item
                    </button>
                </div>

                <!-- Items Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Discount (%)</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tax (%)</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody id="itemsTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Items will be added dynamically -->
                        </tbody>
                    </table>
                </div>

                <p id="noItemsMessage" class="text-center text-gray-500 py-8">No items added. Click "Add Item" to start.</p>
            </div>

            <!-- Order Summary & Notes -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Notes
                    </label>
                    <textarea id="notes" name="notes" rows="6"
                        placeholder="Add any additional notes or special instructions..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                </div>

                <!-- Order Summary -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-medium text-gray-900" id="summarySubtotal">$0.00</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Total Discount:</span>
                            <span class="font-medium text-red-600" id="summaryDiscount">-$0.00</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Total Tax:</span>
                            <span class="font-medium text-gray-900" id="summaryTax">$0.00</span>
                        </div>
                        <div class="pt-3 border-t border-gray-300">
                            <div class="flex justify-between">
                                <span class="text-lg font-semibold text-gray-900">Grand Total:</span>
                                <span class="text-lg font-bold text-indigo-600" id="summaryGrandTotal">$0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row gap-4 justify-end pt-6 border-t">
                <a href="/sales" 
                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-center">
                    Cancel
                </a>
                <button type="submit" 
                    class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors">
                    Create Order
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Add Customer Modal -->
<div id="addCustomerModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-md w-full p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold text-gray-900">Add New Customer</h3>
            <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeAddCustomerModal()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="addCustomerForm">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="tel" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                    <input type="text" name="company" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <textarea name="address" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"></textarea>
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="button" onclick="closeAddCustomerModal()" 
                    class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    Cancel
                </button>
                <button type="submit" 
                    class="flex-1 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                    Add Customer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Product data with prices
const products = [
    { id: 1, name: 'Laptop - Dell XPS 15', sku: 'LAP-001', price: 1299.99 },
    { id: 2, name: 'Monitor - LG 27" 4K', sku: 'MON-001', price: 449.99 },
    { id: 3, name: 'Keyboard - Mechanical RGB', sku: 'KEY-001', price: 89.99 },
    { id: 4, name: 'Mouse - Wireless Ergonomic', sku: 'MOU-001', price: 49.99 },
    { id: 5, name: 'Desk Chair - Executive', sku: 'CHR-001', price: 299.99 },
    { id: 6, name: 'Desk - Standing Adjustable', sku: 'DSK-001', price: 599.99 }
];

// Customer data
const customers = {
    '1': { email: 'contact@acme.com', phone: '+1 (555) 123-4567', company: 'Acme Corporation' },
    '2': { email: 'info@techstart.com', phone: '+1 (555) 234-5678', company: 'TechStart Inc.' },
    '3': { email: 'hello@global.com', phone: '+1 (555) 345-6789', company: 'Global Solutions Ltd.' },
    '4': { email: 'team@innovation.com', phone: '+1 (555) 456-7890', company: 'Innovation Partners' }
};

let itemCounter = 0;

// Set default order date to today
document.getElementById('order_date').valueAsDate = new Date();

// Set default due date to 30 days from now
const dueDate = new Date();
dueDate.setDate(dueDate.getDate() + 30);
document.getElementById('due_date').valueAsDate = dueDate;

// Customer selection handler
document.getElementById('customer_id').addEventListener('change', function() {
    const customerId = this.value;
    const customerDetails = document.getElementById('customerDetails');
    
    if (customerId && customers[customerId]) {
        const customer = customers[customerId];
        document.getElementById('customerEmail').textContent = customer.email;
        document.getElementById('customerPhone').textContent = customer.phone;
        document.getElementById('customerCompany').textContent = customer.company;
        customerDetails.classList.remove('hidden');
    } else {
        customerDetails.classList.add('hidden');
    }
});

// Add Item button handler
document.getElementById('addItemBtn').addEventListener('click', function() {
    addItemRow();
});

// Add Customer button handler
document.getElementById('addCustomerBtn').addEventListener('click', function() {
    document.getElementById('addCustomerModal').classList.remove('hidden');
});

function closeAddCustomerModal() {
    document.getElementById('addCustomerModal').classList.add('hidden');
    document.getElementById('addCustomerForm').reset();
}

// Add Customer Form submit
document.getElementById('addCustomerForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    
    try {
        const response = await App.API.post('/sales/customers/store', data);
        if (response.success) {
            App.Toast.success('Customer added successfully');
            // Add new customer to dropdown
            const select = document.getElementById('customer_id');
            const option = document.createElement('option');
            option.value = response.customer.id;
            option.textContent = response.customer.name;
            select.appendChild(option);
            select.value = response.customer.id;
            select.dispatchEvent(new Event('change'));
            closeAddCustomerModal();
        } else {
            App.Toast.error(response.message || 'Failed to add customer');
        }
    } catch (error) {
        App.Toast.error('An error occurred. Please try again.');
        console.error('Error:', error);
    }
});

function addItemRow() {
    itemCounter++;
    const tbody = document.getElementById('itemsTableBody');
    const row = document.createElement('tr');
    row.id = `item-row-${itemCounter}`;
    row.className = 'item-row';
    
    row.innerHTML = `
        <td class="px-4 py-3">
            <select name="items[${itemCounter}][product_id]" class="product-select w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 text-sm" required>
                <option value="">Select Product</option>
                ${products.map(p => `<option value="${p.id}" data-price="${p.price}">${p.name} (${p.sku})</option>`).join('')}
            </select>
        </td>
        <td class="px-4 py-3">
            <input type="number" name="items[${itemCounter}][quantity]" min="1" value="1" 
                class="quantity-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 text-sm" required>
        </td>
        <td class="px-4 py-3">
            <input type="number" name="items[${itemCounter}][unit_price]" step="0.01" min="0" value="0.00" 
                class="unit-price-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 text-sm" required>
        </td>
        <td class="px-4 py-3">
            <input type="number" name="items[${itemCounter}][discount]" step="0.01" min="0" max="100" value="0" 
                class="discount-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 text-sm">
        </td>
        <td class="px-4 py-3">
            <input type="number" name="items[${itemCounter}][tax]" step="0.01" min="0" max="100" value="0" 
                class="tax-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 text-sm">
        </td>
        <td class="px-4 py-3">
            <span class="item-total font-medium text-gray-900">$0.00</span>
        </td>
        <td class="px-4 py-3">
            <button type="button" onclick="removeItemRow(${itemCounter})" 
                class="text-red-600 hover:text-red-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        </td>
    `;
    
    tbody.appendChild(row);
    
    // Add event listeners for calculations
    const productSelect = row.querySelector('.product-select');
    const quantityInput = row.querySelector('.quantity-input');
    const unitPriceInput = row.querySelector('.unit-price-input');
    const discountInput = row.querySelector('.discount-input');
    const taxInput = row.querySelector('.tax-input');
    
    productSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        if (price) {
            unitPriceInput.value = parseFloat(price).toFixed(2);
            calculateItemTotal(row);
        }
    });
    
    [quantityInput, unitPriceInput, discountInput, taxInput].forEach(input => {
        input.addEventListener('input', () => calculateItemTotal(row));
    });
    
    document.getElementById('noItemsMessage').classList.add('hidden');
    calculateOrderSummary();
}

function removeItemRow(id) {
    const row = document.getElementById(`item-row-${id}`);
    if (row) {
        row.remove();
        const tbody = document.getElementById('itemsTableBody');
        if (tbody.children.length === 0) {
            document.getElementById('noItemsMessage').classList.remove('hidden');
        }
        calculateOrderSummary();
    }
}

function calculateItemTotal(row) {
    const quantity = parseFloat(row.querySelector('.quantity-input').value) || 0;
    const unitPrice = parseFloat(row.querySelector('.unit-price-input').value) || 0;
    const discountPercent = parseFloat(row.querySelector('.discount-input').value) || 0;
    const taxPercent = parseFloat(row.querySelector('.tax-input').value) || 0;
    
    const subtotal = quantity * unitPrice;
    const discount = subtotal * (discountPercent / 100);
    const afterDiscount = subtotal - discount;
    const tax = afterDiscount * (taxPercent / 100);
    const total = afterDiscount + tax;
    
    row.querySelector('.item-total').textContent = `$${total.toFixed(2)}`;
    calculateOrderSummary();
}

function calculateOrderSummary() {
    let subtotal = 0;
    let totalDiscount = 0;
    let totalTax = 0;
    
    document.querySelectorAll('.item-row').forEach(row => {
        const quantity = parseFloat(row.querySelector('.quantity-input').value) || 0;
        const unitPrice = parseFloat(row.querySelector('.unit-price-input').value) || 0;
        const discountPercent = parseFloat(row.querySelector('.discount-input').value) || 0;
        const taxPercent = parseFloat(row.querySelector('.tax-input').value) || 0;
        
        const itemSubtotal = quantity * unitPrice;
        const discount = itemSubtotal * (discountPercent / 100);
        const afterDiscount = itemSubtotal - discount;
        const tax = afterDiscount * (taxPercent / 100);
        
        subtotal += itemSubtotal;
        totalDiscount += discount;
        totalTax += tax;
    });
    
    const grandTotal = subtotal - totalDiscount + totalTax;
    
    document.getElementById('summarySubtotal').textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById('summaryDiscount').textContent = `-$${totalDiscount.toFixed(2)}`;
    document.getElementById('summaryTax').textContent = `$${totalTax.toFixed(2)}`;
    document.getElementById('summaryGrandTotal').textContent = `$${grandTotal.toFixed(2)}`;
}

// Form submission
document.getElementById('salesOrderForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // Validate items
    const items = document.querySelectorAll('.item-row');
    if (items.length === 0) {
        App.Toast.error('Please add at least one item to the order');
        return;
    }
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    
    // Collect items data
    data.items = [];
    items.forEach(row => {
        const productId = row.querySelector('.product-select').value;
        const quantity = row.querySelector('.quantity-input').value;
        const unitPrice = row.querySelector('.unit-price-input').value;
        const discount = row.querySelector('.discount-input').value;
        const tax = row.querySelector('.tax-input').value;
        
        if (productId) {
            data.items.push({
                product_id: productId,
                quantity: quantity,
                unit_price: unitPrice,
                discount: discount,
                tax: tax
            });
        }
    });
    
    try {
        const response = await App.API.post('/sales/store', data);
        if (response.success) {
            App.Toast.success('Sales order created successfully');
            setTimeout(() => {
                window.location.href = '/sales';
            }, 1000);
        } else {
            App.Toast.error(response.message || 'Failed to create sales order');
        }
    } catch (error) {
        App.Toast.error('An error occurred. Please try again.');
        console.error('Error:', error);
    }
});

// Add first item row on page load
addItemRow();
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../layout/user_layout.php';
?>
