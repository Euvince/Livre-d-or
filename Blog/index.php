<?php

require_once "../Class/Post.php";

$pdo = new PDO('sqlite:.../data.db', null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);
$error = null;
$success = null;

try{
    if(isset($_POST['content'], $_POST['name'])):
        $query->$pdo->prepare('INSERT INTO posts (name, content, created_at) VALUES (:name, :content, :created)');
        $query->execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'created' => time()
        ]);
        header('Location: /Blog/edit.php?id=' .$pdo->lastInsertId());
    endif;

    $query = $pdo->query('SELECT * FROM posts');
    $posts = $query->fetchAll(PDO::FETCH_CLASS, 'Post');
}
catch (PDOException $e)
{
    $error = $e->getMessage();
}

require "../Elements/header.php"; ?>

<div class="container">
    <?php if($error): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php else: ?>
        <ul>
            <?php foreach($posts as $post): ?>
            <h2><a href="/Blog/edit.php?id=<?= $post->id ?>"><?= htmlentities($post->name); ?></a></h2>
            <p class="small text-muted">Ecrit le <?= $post->created_at->format('d/m/Y H:i') ?></p>
            <p>
                <?= nl2br(htmlentities($post->getBody())) ?>
            </p>
            <?php endforeach; ?>
        </ul>

        <form action="" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <textarea name="content" class="form-control"></textarea>
            </div>
            <button class="btn btn-primary">Sauvegarder</button>
        </form>
    <?php endif; ?>
</div>

<?php require "../Elements/footer.php"; ?>

