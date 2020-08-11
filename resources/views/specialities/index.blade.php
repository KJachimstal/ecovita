@forelse ($specialities as $speciality)
    <li>
        <a href="{{ url('specialities', [$speciality->id]) }}">
            {{ $speciality->name }}
        </a>
    </li>
@empty
    <p>No specialities</p>
@endforelse