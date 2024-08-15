<x-layout>
    <x-slot:btn>
        <a href="{{route('task.create')}}" class="btn btn-primary">
            Criar tarefa
        </a>
        <a href="{{route('logout')}}" class="btn btn-primary">
            Sair
        </a>
    </x-slot:btn>
    <section class="graph">
        <div class="graph_header">
            <h2> Progresso do dia </h2>
            <div class="graph_header_line"></div>
             <div class="graph_header-date">
                <a href="{{route('home', ['date' => $date_prev_button])}}">
                    <img src="assets/images/icon-prev.png" alt="icon-prev" />
                </a>
                <x-form.text_input type="date" name="date_as_string" onfocus="onfocus=this.showPicker()" value="{{$date_as_string}}" onchange="dateVerif(this)" />
                <a href="{{route('home', ['date' => $date_next_button])}}">
                    <img src="assets/images/icon-next.png" alt="icon-next"/>
                </a>
             </div>
        </div>
        <div class="graph_header-subtitle">Tarefas <b>{{$undone_tasks_count}}/{{$tasks_count}}</b></div>
        <div class="graph_placeholder">

        </div>
        <div class="tasks_left_footer">
            <img src="assets/images/icon-info.png" alt=""/>
            Restam {{$undone_tasks_count}} tarefas para serem realizadas
        </div>
    </section>
    <section class="list">
        <div class="list_header">
            <select class="list_header-select" onchange="changeTaskStatusFilter(this)">
                <option value="all_task"> Todas as tarefas </option>
                <option value="task_pending"> Tarefas pendentes </option>
                <option value="task_done"> Tarefas realizadas </option>
            </select>
        </div>
        <div class="task_list">

            @foreach ($tasks as $task)
                <x-task :data=$task/>
            @endforeach

            <div class="navigation">
                {!! $tasks->links() !!}
            </div>

        </div>
    </section>

    <script>

        async function dateVerif(e){
            // let dataAtual = {!! json_encode($date_as_string) !!};
            let dataAtualizada = e.value;
            // alert(dataAtual);
            // alert(dataAtualizada);

            let url = '{{route('home')}}/?date=' + dataAtualizada;
            document.location.href=url;
        }

        function changeTaskStatusFilter(e){
            // alert(e.value);
            if(e.value == 'task_pending'){
                showAllTasks();
                document.querySelectorAll('.task_done').forEach(function(element){
                    element.style.display = 'none';
                });
            }else if(e.value == 'task_done'){
                showAllTasks()
                document.querySelectorAll('.task_pending').forEach(function(element){
                    element.style.display = 'none';
                });
            }else{
                showAllTasks();
            }
        }

        function showAllTasks(){
            document.querySelectorAll('.task').forEach(function(element){
                element.style.display = 'flex';
            });
        }
    </script>

   <script>
       async function taskUpdate(element){
           let status = element.checked;
           let taskId = element.dataset.id;

           let url = '{{route('task.update')}}';

           let rawResult = await fetch(url, {
               method: 'POST',
               headers: {
                   'Content-type': 'application/json',
                   'accept': 'application/json'
                },
                body: JSON.stringify({status, taskId, _token: '{{csrf_token()}}'})
            });

           result = await rawResult.json();
           if(result.success){
            alert('Task atualizada com sucesso');
           }else{
            element.checked = !status; //se der erro, atualiza o checkbox diferente do status(modificação)
           }
       }
   </script>

</x-layout>
