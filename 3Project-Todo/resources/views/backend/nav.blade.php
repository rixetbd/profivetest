<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{route('users.index')}}">Todo.</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('tasks.index')}}">Task List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('users.index')}}">User List</a>
                </li>

                @auth
                <li class="nav-item">
                    <a class="nav-link btn btn-danger btn-sm text-white ms-3" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
