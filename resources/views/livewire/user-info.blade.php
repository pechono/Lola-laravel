<div>
    @if ($user)
       <div class="text-xl font-bold  p-2 rounded-lg flex justify-center items-center mr-4 border border-teal-900">Usuario: {{ $user->name }}</div>
    @else
        <p>No hay un usuario autenticado.</p>
    @endif
</div>

