@forelse ($users as $user)
    <li>
        <a href="{{ url('users', [$user->id]) }}">
            {{ $user->name }} {{ $user->surname }}
        </a>
    </li>
@empty
    <p>No users</p>
@endforelse