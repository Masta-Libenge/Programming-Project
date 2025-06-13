@auth
    @if (Auth::user()->type === 'student')
        {{-- STUDENT --}}
        <nav class="fixed top-0 left-0 right-0 bg-white shadow-md z-50 h-16 border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-between">
                <a href="{{ url('/') }}" class="text-[--accent] font-bold text-xl tracking-tight">CareerLaunch</a>
                <ul class="flex space-x-6 items-center">
                    <li>
                        <a href="{{ route('vacatures.index') }}" class="text-[--text] hover:text-[--accent] font-medium transition-colors">
                            Vacatures
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('student.profile') }}" class="text-[--text] hover:text-[--accent] font-medium transition-colors">
                            Profiel
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('student.planning') }}" class="text-[--text] hover:text-[--accent] font-medium transition-colors">
                            Planning
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('student.mailbox') }}" class="text-[--text] hover:text-[--accent] font-medium transition-colors">
                            Mailbox
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('student.dashboard') }}" class="text-[--text] hover:text-[--accent] font-medium transition-colors">
                            Dashboard
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    @elseif (Auth::user()->type === 'bedrijf')
        {{-- BEDRIJF --}}
        <nav class="fixed top-0 left-0 right-0 bg-white shadow-md z-50 h-16 border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-between">
                <a href="{{ url('/') }}" class="text-[--accent] font-bold text-xl tracking-tight">CareerLaunch</a>
                <ul class="flex space-x-6 items-center">
                    <li>
                        <a href="{{ route('vacatures.index') }}" class="text-[--text] hover:text-[--accent] font-medium transition-colors">
                            Vacatures
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('bedrijf.dashboard') }}" class="text-[--text] hover:text-[--accent] font-medium transition-colors">
                            Dashboard
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    @endif
@endauth
