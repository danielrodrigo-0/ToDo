<x-layout page="Editar tarefa">
    <x-slot:btn>
        <a href="{{route('home')}}" class="btn btn-primary">
            Voltar
        </a>
    </x-slot:btn>

    <section id="task_section" class="m-auto pt-3">
        <h1 class="text-center mb-3">Editar tarefa</h1>
        <form method="POST" action="{{route('task.edit_action')}}">
            @csrf
            <input type="hidden" name="id" value="{{$task->id}}" />
            <x-form.chkbox_input type="checkbox" name="is_done" label="Foi concluída?" checked="{{$task->is_done}}"/>
            <x-form.text_input name="title" label="Titulo da task" placeholder="Digite o titulo da tarefa" required="required" value="{{$task->title}}"/>
            <x-form.text_input type="dateTime-local" name="due_date" label="Data de Realização" required="required" onfocus="onfocus=this.showPicker()" value="{{$task->due_date}}"/>
            <x-form.select_input name="category_id" label="Categoria" required="required">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}"
                        @if($category->id == $task->category_id)
                            selected
                        @endif
                        >{{$category->title}}</option>
                @endforeach
            </x-form.select_input>
            <x-form.textarea_input name="description" placeholder="Digite a descrição da tarefa" label="Descrição da tarefa" value="{{$task->description}}"/>

            <x-form.form_btn resetTxt="Limpar" submitTxt="Atualizar tarefa" />

        </form>
    </section>

</x-layout>
