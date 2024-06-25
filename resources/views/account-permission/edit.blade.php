<div class="modal fade" id="editPermissionModal{{ $user->id }}" tabindex="-1" aria-labelledby="editPermissionModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPermissionModalLabel{{ $user->id }}">Edit Permission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('account-permission.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name{{ $user->id }}">Name</label>
                        <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email{{ $user->id }}">Email</label>
                        <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                    </div>
                    @if(auth()->user()->role != 'user' || auth()->user()->id == $user->id)
                    <div class="form-group">
                        <label for="role{{ $user->id }}">Role</label>
                        <select class="form-control" id="role{{ $user->id }}" name="role" required>
                            <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                            <option value="user" @if($user->role == 'user') selected @endif>User</option>
                        </select>
                    </div>
                    @endif
                    {{-- <div class="form-group">
                        <label for="amount{{ $user->id }}">Amount</label>
                        <input type="number" class="form-control" id="amount{{ $user->id }}" name="amount" value="{{ $user->wallet }}" required>
                    </div> --}}
                    <div class="form-group">
                        <label for="password{{ $user->id }}">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password{{ $user->id }}" name="password">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword{{ $user->id }}"><i class="fa fa-eye-slash"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation{{ $user->id }}">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password_confirmation{{ $user->id }}" name="password_confirmation">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Toggle password visibility for edit forms (loop through all edit forms)
    document.getElementById('togglePassword{{ $user->id }}').addEventListener('click', function () {
        const passwordInput = document.getElementById('password{{ $user->id }}');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye-slash');
        this.querySelector('i').classList.toggle('fa-eye');
    });
</script>
