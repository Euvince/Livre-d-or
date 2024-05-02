<?php

$pdo = new PDO('sqlite:.../data.db', null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);
$error = null;
$success = null;

// $pdo->quote($_GET['id']); POUR QUERY POUR LA SECURITÉ

try{
    if(isset($_POST['content'], $_POST['name'])):
        $query->$pdo->prepare('UPDATE posts SET name = :name, content = :content WHERE id = :id');
        $query->execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'id' => $_GET['id']
        ]);
        $success = 'Votre article a bien été modifié';
    endif;
    
    $query = $pdo->prepare('SELECT * FROM posts WHERE id = :id');
    $query->execute([
        'id' => $_GET['id']
    ]);
    $posts = $query->fetch();
}
catch (PDOException $e)
{
    $error = $e->getMessage();
}

require "../Elements/header.php"; ?>

<div class="container">
    <p>
        <a href="/Blog">Revenir au listing</a>
    </p>
    <?php if($success): ?>
        <div class="alert alert-success"><?= $success; ?></div>
    <?php endif; ?>
    <?php if($error): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
        <?php else: ?>
            <form action="" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" value="<?= htmlentities($post->name); ?>">
                </div>
                <div class="form-group">
                    <textarea name="content" class="form-control"><?= htmlentities($post->content); ?></textarea>
                </div>
                <button class="btn btn-primary">Sauvegarder</button>
            </form>
    <?php endif; ?>
</div>

<?php require "../Elements/footer.php"; ?>