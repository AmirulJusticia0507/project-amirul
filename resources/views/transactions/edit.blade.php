<!-- Edit Modal -->
<div class="modal fade" id="editTransactionModal{{ $transaction->id }}" tabindex="-1" aria-labelledby="editTransactionModalLabel{{ $transaction->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTransactionModalLabel{{ $transaction->id }}">Edit Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_product_id">Product</label>
                        <select class="form-control" id="edit_product_id" name="product_id" required>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ $transaction->product_id == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_amount">Amount</label>
                        <input type="text" class="form-control" id="edit_amount" name="amount" value="{{ $transaction->amount }}" required>
                    </div>
                    <!-- Timestamp tidak ditampilkan karena akan diupdate secara otomatis -->
                    <div class="form-group" style="display: none;">
                        <label for="edit_timestamp">Timestamp</label>
                        <input type="text" class="form-control" id="edit_timestamp" name="timestamp" value="{{ $transaction->timestamp }}" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_status">Status</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="1" {{ $transaction->status == 1 ? 'selected' : '' }}>Success</option>
                            <option value="2" {{ $transaction->status == 2 ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
