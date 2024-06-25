<!-- Add Transaction Modal -->
<div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTransactionModalLabel">Add Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('transactions.store') }}" method="POST" onsubmit="return checkBalance()">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="walletBalance">Wallet Balance: </label>
                        <input type="text" class="form-control" id="walletBalance" name="walletBalance" value="{{ $walletBalance }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="product_id">Product</label>
                        <select class="form-control" id="product_id" name="product_id" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="1">Success</option>
                            <option value="2">Failed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="totalAmount">Total Amount</label>
                        <input type="text" class="form-control" id="totalAmount" name="totalAmount" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Transaction</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Function to calculate total amount based on selected product and input amount
    function calculateTotalAmount() {
        var productPrice = parseFloat($('#product_id option:selected').data('price'));
        var amount = parseFloat($('#amount').val());
        var totalAmount = productPrice * amount;
        $('#totalAmount').val(totalAmount.toFixed(2)); // Display total amount with two decimals
    }

    // Call calculateTotalAmount function when product or amount changes
    $('#product_id, #amount').change(function() {
        calculateTotalAmount();
    });

    // Function to check if the transaction amount exceeds wallet balance
    function checkBalance() {
        var walletBalance = parseFloat(document.getElementById('walletBalance').value);
        var amount = parseFloat(document.getElementById('amount').value);

        if (amount > walletBalance) {
            alert('Insufficient wallet balance!');
            return false;
        }

        return true;
    }

    // Initial call to calculate total amount when the page loads
    calculateTotalAmount();
</script>
