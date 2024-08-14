<x-layout page="Todo Register">
    <x-slot:btn>
        <a href="{{route('login')}}" class="btn btn-primary">
            Já possui conta? Faça Login
        </a>
    </x-slot:btn>
    <section id="task_section">
        <h1>Registrar-se</h1>

        @if ($errors->any())
            <ul class="alert-error">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach

            </ul>
        @endif
        <form method="POST" action="{{route('user.register_action')}}">
            @csrf
            <x-form.text_input name="name" label="Nome:" placeholder="Digite seu nome" required="required" />
            <x-form.text_input type="email" name="email" label="E-mail:" placeholder="Digite seu e-mail:" required="required" />
            <x-form.text_input type="password" name="password" label="Senha:" placeholder="Digite sua senha" required="required" />
            <x-form.text_input type="password" name="password_confirmation" label="Confirme sua senha:" placeholder="Confirma sua senha" required="required" />

            <x-form.form_btn resetTxt="Limpar" submitTxt="Registrar-se" />

        </form>
    </section>
</x-layout>
