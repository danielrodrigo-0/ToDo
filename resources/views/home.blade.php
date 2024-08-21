<script>
    function changeTaskStatusFilter(e) {
        // Cria um objeto URL para manipular a URL atual
        const url = new URL(window.location.href);
        const params = new URLSearchParams(url.search);

        // Atualiza ou adiciona o parâmetro de filtro
        params.set('filter', e.value);

        // Define a URL atualizada
        const newUrl = url.origin + url.pathname + '?' + params.toString();

        // Redireciona para a nova URL
        window.location.href = newUrl;
    }

    function setInitialFilter() {
        // Obtém o valor do parâmetro de filtro da URL
        const url = new URL(window.location.href);
        const params = new URLSearchParams(url.search);
        const filter = params.get('filter');

        // Define o valor selecionado no <select> com base no parâmetro de filtro
        if (filter) {
            document.getElementById('task_filter').value = filter;
        }
    }

    // Define o filtro inicial quando a página é carregada
    window.onload = setInitialFilter;
</script>
<x-layout>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <x-slot:btn>
        <a href="{{ route('task.create') }}" class="btn btn-primary">
            Criar tarefa
        </a>
        <a href="{{ route('logout') }}" class="btn btn-primary">
            Sair
        </a>
    </x-slot:btn>
    <section class="graph">
        <div class="graph_header">
            <h2> Progresso do dia </h2>
            <div class="graph_header_line"></div>
            <div class="graph_header-date">
                <a href="{{ route('home', ['date' => $date_prev_button]) }}">
                    <img src="assets/images/icon-prev.png" alt="icon-prev" />
                </a>
                <x-form.text_input type="date" name="date_as_string" onfocus="onfocus=this.showPicker()" value="{{ $date_as_string }}" onchange="dateVerif(this)" />
                <a href="{{ route('home', ['date' => $date_next_button]) }}">
                    <img src="assets/images/icon-next.png" alt="icon-next" />
                </a>
            </div>
        </div>
        <div class="graph_header-subtitle">Tarefas <b>{{ $tasks_count - $undone_tasks_count }}/{{ $tasks_count }}</b></div>
        <div id="radial-chart" class="graph_placeholder">
            <script>
                let done = @json($tasks_count - $undone_tasks_count);
                let todo = @json($undone_tasks_count);
                let total = @json($tasks_count);
                done = (done / total) * 100;
                todo = (todo / total) * 100;
                // alert(done);
                const getChartOptions = () => {
                    return {
                        series: [Math.round(todo), Math.round(done)],
                        colors: ["#6143FF", "#1C64F2"],
                        chart: {
                            height: "380px",
                            width: "100%",
                            type: "radialBar",
                            sparkline: {
                                enabled: true,
                            },
                        },
                        plotOptions: {
                            radialBar: {
                                track: {
                                    background: '#E5E7EB',
                                },
                                dataLabels: {
                                    show: true,
                                },
                                hollow: {
                                    margin: 0,
                                    size: "50%",
                                }
                            },
                        },
                        grid: {
                            show: false,
                            strokeDashArray: 4,
                            padding: {
                                left: 2,
                                right: 2,
                                top: -23,
                                bottom: -20,
                            },
                        },
                        labels: ["Pendentes",  "Realizadas"],
                        legend: {
                            show: true,
                            position: "bottom",
                            fontFamily: "Inter, sans-serif",
                        },
                        tooltip: {
                            enabled: true,
                            x: {
                                show: false,
                            },
                        },
                        yaxis: {
                            show: false,
                            labels: {
                                formatter: function(value) {
                                    return value + '%';
                                }
                            }
                        }
                    }
                }

                if (document.getElementById("radial-chart") && typeof ApexCharts !== 'undefined') {
                    const chart = new ApexCharts(document.querySelector("#radial-chart"), getChartOptions());
                    chart.render();
                }
            </script>
            {{-- renderChart({{ $tasks_count }}, {{ $undone_tasks_count }}); --}}
        </div>
        <div class="tasks_left_footer">
            <img src="assets/images/icon-info.png" alt="icon-info" />
            Restam {{ $undone_tasks_count }} tarefas para serem realizadas
        </div>
    </section>
    <section class="list">
        <div class="list_header">
            <select id="task_filter" class="list_header-select" onchange="changeTaskStatusFilter(this)">
                <option value="all_task"> Todas as tarefas </option>
                <option value="task_pending"> Tarefas pendentes </option>
                <option value="task_done"> Tarefas realizadas </option>
            </select>
        </div>
        <div class="task_list">
            @if ($filter == 'task_pending')
                @foreach ($tasks_pending as $pending)
                    <x-task :data=$pending />
                @endforeach
                <div class="navigation">
                    {{ $tasks_pending->appends(request()->query())->links('') }}
                </div>
            @elseif($filter == 'task_done')
                @foreach ($tasks_done as $done)
                    <x-task :data=$done />
                @endforeach
                <div class="navigation">
                    {{ $tasks_done->appends(request()->query())->links('') }}
                </div>
            @else
                @foreach ($tasks as $task)
                    <x-task :data=$task />
                @endforeach
                <div class="navigation">
                    {{ $tasks->appends(request()->query())->links('') }}
                </div>
            @endif

        </div>
    </section>

    <script>
        async function dateVerif(e) {
            // let dataAtual = {!! json_encode($date_as_string) !!};
            let dataAtualizada = e.value;

            let url = '{{ route('home') }}/?date=' + dataAtualizada;
            document.location.href = url;
        }
    </script>
    <script>
        async function taskUpdate(element) {
            let status = element.checked;
            let taskId = element.dataset.id;

            let url = '{{ route('task.update') }}';

            let rawResult = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json',
                    'accept': 'application/json'
                },
                body: JSON.stringify({
                    status,
                    taskId,
                    _token: '{{ csrf_token() }}'
                })
            });

            result = await rawResult.json();
            if (result.success) {
                alert('Task atualizada com sucesso');
                window.location.reload();
            } else {
                element.checked = !status; //se der erro, atualiza o checkbox diferente do status(modificação)
            }
        }
    </script>

</x-layout>
