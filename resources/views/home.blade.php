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
                <a href="{{ route('home', ['date' => $date_prev_button]) }}">
                    <img src="assets/images/icon-prev.png" alt="icon-prev" />
                </a>
                <x-form.text_input id="filterDate" class="m-0" type="date" name="" onfocus="onfocus=this.showPicker()" value="{{ $date_as_string }}" />
                <a href="{{ route('home', ['date' => $date_next_button]) }}">
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
                        colors: ["#6143FF", "#1C64F2"],
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
            <img src="assets/images/icon-info.png" alt="icon-info" />
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
        document.addEventListener("DOMContentLoaded", function() {
            let urlBase = '{{ route('home') }}/?date=';
            let typingTimer;
            let doneTypingInterval = 4000;

            function isValidDate(dateString) {
                // Verifica se a string está no formato yyyy-mm-dd e se é uma data válida
                const regex = /^\d{4}-\d{2}-\d{2}$/;
                if (!regex.test(dateString)) return false;

                const date = new Date(dateString);
                return date instanceof Date && !isNaN(date);
            }

            function redirectToDate(dateSet) {
                if (dateSet && isValidDate(dateSet) && !document.target) {
                    let url = urlBase + encodeURIComponent(dateSet);
                    window.location.href = url; // Redireciona para a nova URL com a data
                } else {
                    window.location.href = '{{ route('home') }}'; // Redireciona para a URL padrão se a data não for válida
                }
            }

            function doneTyping() {
                redirectToDate(filterDate.value);
            }

            filterDate.addEventListener("keydown", function(e) {
                if (e.keyCode === 13) {
                    document.activeElement.blur();
                    e.preventDefault(); // Previne o comportamento padrão do Enter
                    doneTyping();
                }
            });

            filterDate.addEventListener("focusout", function() {
                clearTimeout(typingTimer);
                if (filterDate.value) {
                    doneTyping();
                }
            });

            // async function filterDate(e) {
            //     let dateSet = e.value;

            //     if (dateSet != "") {
            //         url = '{{ route('home') }}/?date=' + dateSet;
            //     }
            //     document.location.href = url;
            // }
        });
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
