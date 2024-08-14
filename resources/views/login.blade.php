<x-layout page="Todo Login">
    <x-slot:btn>
        <a href="{{route('register')}}" class="btn btn-primary">
            Registre-se
        </a>
    </x-slot:btn>
    <section id="task_section">
        <h1>Faça Login</h1>

        @if ($errors->any())
            <ul class="alert-error">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach

            </ul>
        @endif
        <form method="POST" action="{{route('user.login_action')}}">
            @csrf
            <x-form.text_input type="email" name="email" label="E-mail:" placeholder="Digite seu e-mail:" required="required" />
            <x-form.text_input type="password" name="password" label="Senha:" placeholder="Digite sua senha" required="required" />

            <x-form.form_btn resetTxt="Limpar" submitTxt="Entrar" />

        </form>
    </section>
</x-layout>
