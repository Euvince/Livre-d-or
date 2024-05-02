<?php

require "vendor/autoload.php";

use App\Guestbook\{
    GuestBook,
    Message
};

// use App\Guestbook\Message as ContactMessage;

/* require_once "Class/Message.php";
require_once "Class/GuestBook.php";

require_once "Class/Contact/Message.php"; */

$errors = null;
$success = false;

// $demo = new ContactMessage();

$guestbook = new GuestBook(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages');

if (isset($_POST['username'], $_POST['message'])):
    $message = new Message($_POST['username'], $_POST['message']);
    if($message-> isValid()):
        $guestbook->addMessage($message);
        $success = true;
        $_POST = [];
    else:
        $errors = $message->getErrors();
    endif;
endif;

$messages = $guestbook->getMessages();
$title = "Livre D'or";
require "Elements/header.php";

?>

<div class="container mt-5">
    <h1>Livre D'or</h1>

    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
           Formulaire Invalide
        </div>
    <?php endif; ?>

    <?php if($success): ?>
        <div class="alert alert-success">
           Votre message a été enrégistré
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <input type="text" name="username" placeholder="Votre Pseudo" class="form-control <?= isset($errors['username']) ? 'is-invalid' : ' '; ?>" value="<?= htmlentities($_POST['username'] ?? '') ?>">
            <?php if (isset($errors['username'])): ?>
                <div class="invalid-feedback"><?= $errors['username']; ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group mt-3">
            <textarea name="message" class="form-control <?= isset($errors['message']) ? 'is-invalid' : ' '; ?>"><?= htmlentities($_POST['message'] ?? '') ?></textarea>
            <?php if (isset($errors['message'])): ?>
                <div class="invalid-feedback"><?= $errors['message']; ?></div>
            <?php endif; ?>
        </div>
        <button class="btn btn-primary mt-3">Envoyer</button>
    </form>

    <?php if (!empty($messages)): ?>
        <h1 class="mt-4">Vos Messages</h1>

        <?php foreach($messages as $message): ?>
            <?= $message->toHTML(); ?>
        <?php endforeach; ?>
    <?php endif; ?>

</div>

<?php require "Elements/header.php"; ?>