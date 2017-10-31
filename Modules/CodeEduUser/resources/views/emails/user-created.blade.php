<h3>{{config('app.name')}}</h3>
<p>Sua conta na plataforma foi criada com sucesso!</p>
<p>O próximo passo, é ativar sua conta!</p>
<p>Usuário: <strong>{{$user->email}}</strong></p>
<p>
    <?php
        $link = route('codeeduuser.email-verification.check', $user->verification_token).'?email'.urlencode($user->email);
    ?>

    Clique aqui para ativar: <a href="{{$link}}">{{$link}}</a>
</p>
<p>Obs.: Não responda este e-mail! Ele foi gerado automaticamente!</p>