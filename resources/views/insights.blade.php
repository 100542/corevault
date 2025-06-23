<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corevault - Insights</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="bg-[#040604] text-white overflow-x-hidden">
@include('nav')

<main class="p-10">
    <div class="mb-12">
        <h1 class="text-4xl text-[#C4FFCE] font-bold">Insights & Analysis</h1>
        <p class="text-gray-400 mt-2">Welcome back, <span class="text-[#C4FFCE] font-semibold">{{ $user->username }}</span>!</p>
    </div>
    <div class="flex flex-row justify-between gap-8 mb-12">
        <div class="bg-[#8DB295] p-6 w-1/4 rounded-2xl flex flex-row justify-between items-center shadow-md">
            <div class="w-80 h-80">
                <canvas id="walletPieChart" class="w-full h-full"></canvas>
                <p class="text-sm text-[#040604] text-center font-light">(Values In USD)</p>
            </div>
        </div>
        <div class="bg-[#8DB295] p-6 rounded-2xl shadow-md w-3/4">
            <form id="aiForm" action="{{ route('insights.chat') }}" method="POST" class="flex flex-col gap-2">
                @csrf
                <label for="input" class="text-[#040604] font-bold text-lg">AI Chat</label>
                <input type="text" name="input" x-ref="input"
                       placeholder="Ask anything about trading..."
                       class="text-[#040604] border-2 border-[#040604] bg-transparent placeholder-[#040604]/70 p-3 rounded-md" required>
                <input type="hidden" name="fromHistory" value="0" x-ref="fromHistory">
                <button class="bg-[#040604] p-3 text-[#C4FFCE] rounded-md font-bold">Generate</button>
                <p class="text-sm text-[#040604] text-center">AI responses are based upon your account data, but may not be factual. Trading with this information is at your own risk.</p>
            </form>
        </div>
    </div>
    <!-- white-space: pre-wrap sorts the AI response so it looks nice. -->
    <div style="white-space: pre-wrap;" class="bg-[#8DB295] p-6 rounded-2xl font-bold text-[#040604] shadow-md">
        {{ session('aiOutput') ?? 'You can retrieve your AI output in here.' }}
    </div>

    <div class="absolute bottom-0 -z-10 opacity-10 overflow-x-hidden flex flex-row justify-center gap-4 max-w-[97dvw] items-end">
        @php
            $colors = ['#7CD789', '#8DB295'];
        @endphp

        @for ($i = 0; $i < 40; $i++)
            @php
                $height = rand(300, 600);
                $color = $colors[$i % 2];
            @endphp
            <div class="h-[{{ $height }}px] w-14" style="background-color: {{ $color }}"></div>
        @endfor
    </div>
</main>
</body>
<script>
    const walletLabels = @json($wallets->map(fn($w) => ucfirst($w->type)));
    const walletBalances = @json($wallets->map(fn($w) => round($w->usd_value, 2)));

    const ctx = document.getElementById('walletPieChart').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: walletLabels,
            datasets: [{
                data: walletBalances,
                backgroundColor: [
                    '#8CC299', '#475569', '#C4FFCE', '#040604', '#A3B18A'
                ],
                borderColor: '#040604',
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'left',
                    labels: {
                        color: '#040604',
                        font: { size: 14 }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed.toFixed(6);
                        }
                    }
                }
            }
        }
    });
</script>
</html>
