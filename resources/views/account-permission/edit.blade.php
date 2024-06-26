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
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-eye" id="toggleConfirmPassword{{ $user->id }}"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Permission</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const togglePassword{{ $user->id }} = document.querySelector('#togglePassword{{ $user->id }}');
        const password{{ $user->id }} = document.querySelector('#password{{ $user->id }}');
        togglePassword{{ $user->id }}.addEventListener('click', function (e) {
            const type = password{{ $user->id }}.getAttribute('type') === 'password' ? 'text' : 'password';
            password{{ $user->id }}.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

        const toggleConfirmPassword{{ $user->id }} = document.querySelector('#toggleConfirmPassword{{ $user->id }}');
        const confirmPassword{{ $user->id }} = document.querySelector('#password_confirmation{{ $user->id }}');
        toggleConfirmPassword{{ $user->id }}.addEventListener('click', function (e) {
            const type = confirmPassword{{ $user->id }}.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword{{ $user->id }}.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    });
</script>
@endif
