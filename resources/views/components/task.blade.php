<div class="task {{$data['is_done'] ? 'task_done' : 'task_pending'}}">
    <div class="title">
        <input type="checkbox" onchange="taskUpdate(this)" data-id="{{$data['id']}}"
        @if($data && $data['is_done'])
        checked
        @endif
        />
        <div class="task_title"> {{$data['title'] ?? ''}} </div>
    </div>
    <div class="d-flex flex-row align-items-center" style="flex: 1;">
        <div class="d-flex w-25">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="{{$data['category']->color}}" viewBox="0 0 256 256">
                <path
                    d="M232,128A104,104,0,1,1,128,24,104.13,104.13,0,0,1,232,128Z">
                </path>
            </svg>
        </div>
        <div> {{$data['category']->title ?? ''}} </div>
    </div>
    <div class="actions justify-content-end d-flex flex-row align-items-center" style="flex: 1;">
        <a href="{{route('task.edit', ['id' => $data['id']])}}"> {{-- botao editar --}}
            {{-- <img src="assets/images/icon-edit.png" alt="icon-edit"/> --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" fill="#1C64F2" viewBox="0 0 256 256">
                <path
                d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM51.31,160l90.35-90.35,16.68,16.69L68,176.68ZM48,179.31,76.69,208H48Zm48,25.38L79.31,188l90.35-90.35h0l16.68,16.69Z">
                </path>
            </svg>
        </a>
        {{-- <a href="{{route('task.delete', ['id' => $data['id']])}}"> botao excluir --}}
            <a data-bs-toggle="modal" data-bs-target="#modalTeste" style="cursor: pointer;" data-bs-id={{$data['id']}}>
            {{-- <img src="assets/images/icon-delete.png" alt="icon-delete"/> --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" fill="#6e000b" viewBox="0 0 256 256">
                <path
                d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM112,168a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm0-120H96V40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8Z">
                </path>
            </svg>
        </a>
    </div>
</div>
