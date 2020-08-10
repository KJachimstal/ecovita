@forelse ($users as $user)
    <li>{{ $user->name }}</li>
    <li>{{ $user->pesel }}</li>
@empty
    <p>No users</p>
@endforelse