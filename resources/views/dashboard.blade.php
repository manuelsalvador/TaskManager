<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (Auth::user()->role == 1)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row text-center" style="padding: 30px;">
                    <div class="col-md-3">
                    <a href="/users">
                        <button class="btn btn-info btn-submit">
                            <div><i class="bi bi-people-fill"></i></div>
                            <div>Users</div>    
                        </button>
                    </a>
                    </div>
                    <div class="col-md-3">
                        <a href="/customers">
                            <button class="btn btn-info btn-submit">
                                <div><i class="bi bi-person-fill"></i></i></div>
                                <div>Customers</div>
                            </button>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="/projects">
                            <button class="btn btn-info btn-submit">
                                <div><i class="bi bi-kanban-fill"></i></div>
                                <div>Projects</div></button>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="/tasks">
                            <button class="btn btn-info btn-submit">
                                <div><i class="bi bi-list-task"></i></div>
                                <div>Tasks</div></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if (Auth::user()->role == 2)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row text-center" style="padding: 30px;">                    
                    <div class="col-md-12">
                        <a href="/tasks">
                            <button class="btn btn-info btn-submit">
                            <div><i class="bi bi-list-task"></i></div>
                                <div>View my tasks</div></button>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row text-center" style="padding: 30px;">                    
                    <div class="col-md-12">
                        <a href="/globals">
                            <button class="btn btn-info btn-submit">
                                <div><i class="bi bi-pie-chart-fill"></i></div>
                                <div>Overview</div>
                                </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
