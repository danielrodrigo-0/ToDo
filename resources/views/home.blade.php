<script>
    function changeTaskStatusFilter(e) {
        // Cria um objeto URL para manipular a URL atual
        const url = new URL(window.location.href);
        const params = new URLSearchParams(url.search);

        // Atualiza ou adiciona o parâmetro de filtro
        params.set('filter', e.value);
        params.set('page', 1);

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
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <x-slot:btn>
            <a href="{{ route('task.create') }}" class="btn btn-primary">
                Criar tarefa
            </a>
            <a href="{{ route('logout') }}" class="btn btn-primary">
                Sair
            </a>
    </x-slot:btn>
    <section class="graph container-fluid px-3 pt-3 h-100 w-25">
        <div class="graph_header d-flex justify-content-between align-items-center">
            <h2 class="d-inline-block m-0" style="flex: 2; font-size: 18px;"> Progresso do dia </h2>
            <div class="graph_header_line"></div>
            <div class="d-flex justify-content-center align-items-center mb-0" style="flex: 1; font-size: 10px;">
                <a href="{{ !empty($date_next_button) ? route('home', ['date' => $date_prev_button]) : route('home') }}">
                    <img src="assets/images/icon-prev.png" alt="icon-prev" />
                </a>
                <x-form.text_input class="m-0" type="date" name="filterDate" onfocus="onfocus=this.showPicker()" value="{{ $date_as_string }}" onchange="filterDate(this)" />
                <a href="{{ !empty($date_next_button) ? route('home', ['date' => $date_next_button]) : route('home') }}">
                    <img src="assets/images/icon-next.png" alt="icon-next" />
                </a>
            </div>
        </div>
        <div class="graph_header-subtitle" style="margin-top: 10px;">Tarefas <b>{{ $tasks_count - $undone_tasks_count }}/{{ $tasks_count }}</b></div>
        <div id="radial-chart">
            <script>
                let done = @json($tasks_count - $undone_tasks_count);
                let todo = @json($undone_tasks_count);
                let total = @json($tasks_count);
                done = (done / total) * 100;
                todo = (todo / total) * 100;
                const getChartOptions = () => {
                    return {
                        series: [Math.round(todo), Math.round(done)],
                        colors: ["#1C64F2", "#6143FF"],
                        chart: {
                            height: "430px",
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
                                    show: true, //Habilita exibição dos data labels
                                    name: { //Configura o estilo e visibilidade do nome (opcional)
                                        offsetY: 0,
                                        show: true,
                                    },
                                    value: { //Define o formato e a visibilidade do valor percentual mostrado no centro.
                                        fontSize: '18px',
                                        formatter: function(val) {
                                            return val + '%';
                                        },
                                        show: true,
                                    },
                                    total: { //Exibe um texto personalizado no centro do gráfico, incluindo informações como o total de tarefas.
                                        show: true,
                                        label: 'Total',
                                        formatter: function() {
                                            return total;
                                        },
                                        color: '#0a0040',
                                        fontSize: '18px',
                                    },
                                },
                                hollow: {
                                    margin: 0,
                                    size: "50%",
                                    background: '#fff', // Background color of the hollow area
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
                        labels: ["Pendentes", "Realizadas"],
                        legend: {
                            show: true,
                            position: "bottom",
                            fontFamily: "Rubik, Inter, sans-serif",
                            fontSize: '14px',
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
        </div>
        <div class="tasks_left_footer d-flex flex-row align-items-center justify-content-center" style="margin-top: 50px;">
            {{-- <img src="assets/images/icon-info.png" alt="icon-info" /> --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#6143FF" viewBox="0 0 256 256">
                <path
                d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm16-40a8,8,0,0,1-8,8,16,16,0,0,1-16-16V128a8,8,0,0,1,0-16,16,16,0,0,1,16,16v40A8,8,0,0,1,144,176ZM112,84a12,12,0,1,1,12,12A12,12,0,0,1,112,84Z">
                </path>
            </svg>
            Restam {{ $undone_tasks_count }} tarefas para serem realizadas
        </div>
    </section>
    <section class="container-fluid px-3 pt-3" style="flex: 1;">
        <div class="d-flex">
            <select id="task_filter" class="list_header-select bg-transparent border-0" onchange="changeTaskStatusFilter(this)">
                <option value="all_task"> Todas as tarefas </option>
                <option value="task_pending"> Tarefas pendentes </option>
                <option value="task_done"> Tarefas realizadas </option>
            </select>
        </div>
        @if($tasks->total() != 0) {{-- verifica se possui tasks para então exibir --}}
            <div class="container d-flex flex-row w-100 mt-3 text-center" style="font-size: 17px;">
                <div class="col"> Titulo </div>
                <div class="col"> Categorias </div>
                <div class="col"></div>
            </div>
        @endif
        <div class="d-flex flex-column w-100 mt-3">
            @if ($filter == 'task_pending')
                @foreach ($tasks_pending as $pending)
                    <x-task :data=$pending />
                @endforeach
                {{ $tasks_pending->appends(request()->query())->links('') }}
            @elseif($filter == 'task_done')
                @foreach ($tasks_done as $done)
                    <x-task :data=$done />
                @endforeach
                {{ $tasks_done->appends(request()->query())->links('') }}
            @else
                @foreach ($tasks as $task)
                    <x-task :data=$task />
                @endforeach
                {{ $tasks->appends(request()->query())->links('') }}
            @endif

        </div>
    </section>

    <script>
            async function filterDate(e) {
                let url = '{{ route('home') }}';
                let dateSet = e.value;

                if (dateSet != "") {
                    url = '{{ route('home') }}/?date=' + dateSet;
                }
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
