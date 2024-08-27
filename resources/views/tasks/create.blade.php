<x-layout page="Criar tarefa">
    <x-slot:btn>
        <a href="{{route('home')}}" class="btn btn-primary">
            Voltar
        </a>
    </x-slot:btn>

    <section class="m-auto pt-3">
        <h1 class="text-center mb-3">Criar tarefa</h1>
        <form method="POST" action="{{route('task.create_action')}}">
            @csrf
            <x-form.text_input name="title" label="Titulo da task" placeholder="Digite o titulo da tarefa" required="required" />
            <x-form.text_input type="dateTime-local" name="due_date" label="Data de Realização" required="required" onfocus="this.showPicker()"/>
            <x-form.select_input name="category_id" label="Categoria" required="required">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </x-form.select_input>
            <x-form.textarea_input name="description" placeholder="Digite a descrição da tarefa" label="Descrição da tarefa" />

            <x-form.form_btn resetTxt="Limpar" submitTxt="Criar tarefa" />

        </form>
    </section>

</x-layout>
