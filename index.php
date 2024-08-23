<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nome da aba do navegador</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/xdry6kco61bzdaz9n34a42sr152ckvo9szynhkgc5sdtrah7/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mensagem'
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('form').addEventListener('submit', function(event) {
                tinymce.triggerSave();  

                if (tinymce.get('mensagem').getContent() === '') {
                    alert('O campo de mensagem é obrigatório.');
                    event.preventDefault();
                }
            });
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Envio de E-mail</h2>

        <?php
        session_start();
        if (isset($_SESSION['mensagem'])) {
            echo "<div class='alert alert-info'>" . $_SESSION['mensagem'] . "</div>";
            unset($_SESSION['mensagem']);
        }
        ?>

        <form action="salva_email.php" method="post">
            <div class="form-group">
                <label for="assunto">Assunto:</label>
                <input type="text" id="assunto" name="assunto" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="para">Para:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    </div>
                    <input type="email" id="para" name="para" class="form-control" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="mensagem">Mensagem:</label>
                <textarea id="mensagem" name="mensagem" class="form-control"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
        </form>
    </div>

   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
