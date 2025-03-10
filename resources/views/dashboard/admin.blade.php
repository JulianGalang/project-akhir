<x-layout>
    <div class="container mx-auto p-4 mt-14">
        <h2 class="text-2xl font-bold mb-4">User Form</h2>

        <form method="POST" action="{{ route('admin.store') }}" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold">Name</label>
                    <input type="text" name="name" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block font-semibold">Username</label>
                    <input type="text" name="username" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block font-semibold">Phone</label>
                    <input type="text" name="phone" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block font-semibold">Email</label>
                    <input type="email" name="email" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block font-semibold">Password</label>
                    <input type="password" name="password" class="w-full p-2 border rounded" required>
                </div>
            </div>
            <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded">Submit</button>
        </form>

        <h2 class="text-2xl font-bold mt-8 mb-4">User List</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2 border">#</th>
                        <th class="p-2 border">Name</th>
                        <th class="p-2 border">Username</th>
                        <th class="p-2 border">Phone</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="text-center border">
                        <td class="p-2 border">{{ $loop->iteration }}</td>
                        <td class="p-2 border">{{ $user->name }}</td>
                        <td class="p-2 border">{{ $user->username }}</td>
                        <td class="p-2 border">{{ $user->phone }}</td>
                        <td class="p-2 border">{{ $user->email }}</td>
                        <td class="p-2 border">
                            <button onclick="editUser({{ $user }})" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</button>
                            <button onclick="deleteUser({{ $user->id }})" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editModal" class="fixed inset-0 hidden z-50 flex items-center justify-center bg-gray-500 bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-lg w-1/3 max-h-[90vh] overflow-auto">
            <h2 class="text-xl font-bold mb-4">Edit User</h2>
            <form id="editForm">
                <input type="hidden" id="editUserId">
                <div>
                    <label class="block font-semibold">Name</label>
                    <input type="text" id="editName" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block font-semibold">Username</label>
                    <input type="text" id="editUsername" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block font-semibold">Phone</label>
                    <input type="text" id="editPhone" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block font-semibold">Email</label>
                    <input type="email" id="editEmail" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block font-semibold">Password</label>
                    <input type="password" id="editPassword" class="w-full p-2 border rounded">
                </div>
                <div class="mt-4">
                    <button type="button" onclick="updateUser()" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                    <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function editUser(user) {
        document.getElementById('editUserId').value = user.id;
        document.getElementById('editName').value = user.name;
        document.getElementById('editUsername').value = user.username;
        document.getElementById('editPhone').value = user.phone;
        document.getElementById('editEmail').value = user.email;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function updateUser() {
    let userId = document.getElementById('editUserId').value;
    let data = {
        name: document.getElementById('editName').value,
        username: document.getElementById('editUsername').value,
        phone: document.getElementById('editPhone').value,
        email: document.getElementById('editEmail').value,
        password: document.getElementById('editPassword').value,
        _token: '{{ csrf_token() }}'
    };

    fetch(`/admin/${userId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(response => response.json())
    .then(data => {
        Swal.fire('Success!', data.message, 'success').then(() => location.reload());
    }).catch(error => {
        Swal.fire('Error!', 'Failed to update user.', 'error');
    });

    closeModal();
}


function deleteUser(userId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json())
            .then(data => {
                Swal.fire('Deleted!', data.message, 'success').then(() => location.reload());
            }).catch(error => {
                Swal.fire('Error!', 'Failed to delete user.', 'error');
            });
        }
    });
}
    </script>
</x-layout>
